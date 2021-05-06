<?php
include "includes/config.php";
$id = $_GET['id'];
$id_watched = $_GET['id_watched'];
$query = "DELETE FROM  watched WHERE id_user=$id AND id_watched=$id_watched;";

$result = mysqli_query($con, $query);

?>
   <meta http-equiv="refresh" content="0; url=shareTo.php" />
