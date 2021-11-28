<?php
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$timezone = date_default_timezone_set("America/Sao_Paulo");

$con = mysqli_connect("localhost", "root", "", "vamosjogar");

if(mysqli_connect_errno()) {
    echo "Falha na conexão: " . mysqli_connect_errno();
}

?>