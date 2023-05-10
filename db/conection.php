<?php
    $host = "localhost";
    $dbname = "smart";
    $username = "root";
    $password = "";
    
    $mysqli = new mysqli($host, $username, $password, $dbname);
    
    if($mysqli->connect_error){
        die('error' .$mysqli->connect_error);
    }
    mysqli_set_charset($mysqli, "utf8"); //formato de datos utf8
    date_default_timezone_set('America/Tegucigalpa');
?>