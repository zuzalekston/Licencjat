<?php
    include("includes/config.php");
    $id = $_GET['id'];
    $id_friend = $_GET['id_friend'];
    $query = "DELETE FROM  Friends WHERE id_user=$id AND id_friend=$id_friend;";
    

    $result = mysqli_query($con, $query);

    ?>
   <meta http-equiv="refresh" content="0; url=shareTo.php" />