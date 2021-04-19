<?php
ob_start();
session_start();
$timezone = date_default_timezone_set("Europe/London");

$dbhost = 'localhost';
$dbuser = 'licencjat';
$dbpass = 'bRyLcrfdOWEQnj8U';
$dbname = 'licencjat';

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Bład połączenia z bazą");

function alert($message)
{
    echo "<div class='alert alert-warning' role='alert'>";
    echo $message;
    echo "</div>";
}
