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
    $query = "DELETE FROM  watched WHERE id_user=$id AND id_watched=$id_watched;";
    $result = mysqli_query($con, $query);
    echo '<meta http-equiv="refresh" content="0; url=obserwuj.php" />';
}

if (isset($_GET['watchedId'])) {
    //ze strony user.php
    $username = $_GET['username'];
    $id_watched = $_GET['watchedId'];
    $query = "DELETE FROM  watched WHERE id_user=$id AND id_watched=$id_watched;";
    $result = mysqli_query($con, $query);
    echo '<meta http-equiv="refresh" content="0; url=user.php?username=' . $username . '" />';
}
