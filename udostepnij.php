<?php
include "includes/config.php";
$id = $_GET['id'];
$id_watched = $_GET['id_watched'];
$query = "INSERT INTO watched VALUES ($id, $id_watched);";

$result = mysqli_query($con, $query);

?>
   <meta http-equiv="refresh" content="0; url=shareTo.php" />
