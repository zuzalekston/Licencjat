<?php
include "includes/config.php";
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$id = $_GET['id'];
if (isset($_GET['id_watched'])) {
    //ze strony obserwuj.php
    $id_watched = $_GET['id_watched'];
    $query = "INSERT INTO watched VALUES ($id, $id_watched);";
    $result = mysqli_query($con, $query);
    echo '<meta http-equiv="refresh" content="0; url=obserwuj.php" />';
}
if (isset($_GET['watchedId'])) {
    //ze strony user.php
    $username = $_GET['username'];
    $id_watched = $_GET['watchedId'];
    $query = "INSERT INTO watched VALUES ($id, $id_watched);";
    $result = mysqli_query($con, $query);
    echo '<meta http-equiv="refresh" content="0; url=user.php?username=' . $username . '" />';
}
