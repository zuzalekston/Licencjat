<?php
ob_start();
session_start();
$timezone = date_default_timezone_set("Europe/London");

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'licencjat';

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Bład połączenia z bazą");

function alert($message)
{
    echo "<div class='alert alert-warning' role='alert'>";
    echo $message;
    echo "</div>";
}

set_time_limit(0);   
ini_set('mysql.connect_timeout','90');   
ini_set('max_execution_time', '1');   