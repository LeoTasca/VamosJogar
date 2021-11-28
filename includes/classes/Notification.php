<?php
class Notification {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function getUnreadNumber() {
		$userLoggedIn = $this->user_obj->getUsername();
		$query = mysqli_query($this->con, "SELECT * FROM notifications WHERE viewed='no' AND user_to='$userLoggedIn'");
		return mysqli_num_rows($query);
	}

	public function getNotifications($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();
		$return_string = "";

		if($page == 1)
			$start = 0;
		else 
			$start = ($page - 1) * $limit;

		$set_viewed_query = mysqli_query($this->con, "UPDATE notifications SET viewed='yes' WHERE user_to='$userLoggedIn'");

		$query = mysqli_query($this->con, "SELECT * FROM notifications WHERE user_to='$userLoggedIn' ORDER BY id DESC");

		if(mysqli_num_rows($query) == 0) {
			echo "Você não tem notificações!";
			return;
		}

		$num_iterations = 0; //Number of messages checked 
		$count = 1; //Number of messages posted

		while($row = mysqli_fetch_array($query)) {

			if($num_iterations++ < $start)
				continue;

			if($count > $limit)
				break;
			else 
				$count++;


			$user_from = $row['user_from'];

			$user_data_query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$user_from'");
			$user_data = mysqli_fetch_array($user_data_query);


			//Timeframe
			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($row['datetime']); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates 
			if($interval->y >= 1) {
				if($interval->y == 1)
					$time_message = $interval->y . " ano atrás"; //1 year ago
				else 
					$time_message = $interval->y . " anos atrás"; //1+ year ago
			}
			else if ($interval->m >= 1) {
				if($interval->d == 0) {
					$days = " atrás";
				}
				else if($interval->d == 1) {
					$days = $interval->d . " dia atrás";
				}
				else {
					$days = $interval->d . " dias atrás";
				}
	
	
				if($interval->m == 1) {
					$time_message = $interval->m . " mês". $days;
				}
				else {
					$time_message = $interval->m . " meses". $days;
				}
	
			}
			else if($interval->d >= 1) {
				if($interval->d == 1) {
					$time_message = "Ontem";
				}
				else {
					$time_message = $interval->d . " dias atrás";
				}
			}
			else if($interval->h >= 1) {
				if($interval->h == 1) {
					$time_message = $interval->h . " hora atrás";
				}
				else {
					$time_message = $interval->h . " horas atrás";
				}
			}
			else if($interval->i >= 1) {
				if($interval->i == 1) {
					$time_message = $interval->i . " minuto atrás";
				}
				else {
					$time_message = $interval->i . " minutos atrás";
				}
			}
			else {
				if($interval->s < 30) {
					$time_message = "Há pouco";
				}
				else {
					$time_message = $interval->s . " segundos atrás";
				}
			}

			$opened = $row['opened'];
			$style = ($opened == 'no') ? "background-color: #DDEDFF;" : "";

			$return_string .= "<a href='" . $row['link'] . "'> 
									<div class='resultDisplay resultDisplayNotification' style='" . $style . "'>
										<div class='notificationsProfilePic'>
											<img src='" . $user_data['profile_pic'] . "'>
										</div>
										<p class='timestamp_smaller' id='grey'>" . $time_message . "</p>" . $row['message'] . "
									</div>
								</a>";
		}


		//If posts were loaded
		if($count > $limit)
			$return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
		else 
			$return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align: center;'>Sem mais notificações para carregar!</p>";

		return $return_string;
	}

	public function insertNotification($post_id, $user_to, $type) {

		$userLoggedIn = $this->user_obj->getUsername();
		$userLoggedInName = $this->user_obj->getFirstAndLastName();

		$date_time = date("Y-m-d H:i:s");

		switch($type) {
			case 'comment':
				$message = $userLoggedInName . " comentou no seu evento";
				break;
			case 'like':
				$message = $userLoggedInName . " quer participar do seu evento";
				break;
			case 'profile_post':
				$message = $userLoggedInName . " publicou no seu perfil";
				break;
			case 'comment_non_owner':
				$message = $userLoggedInName . " comentou em um evento que você comentou";
				break;
			case 'profile_comment':
				$message = $userLoggedInName . " comentou na sua postagem de perfil";
				break;
		}

		$link = "post.php?id=" . $post_id;

		$insert_query = mysqli_query($this->con, "INSERT INTO notifications VALUES (NULL, '$user_to', '$userLoggedIn', '$message', '$link', '$date_time', 'no', 'no')");
	}

}

?>