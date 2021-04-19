
    <?php
    include("includes/config.php");
    $query = 'DELETE FROM Images WHERE id='.$_GET['id_image'].';';

    $result = mysqli_query($con, $query);


    ?>
   <meta http-equiv="refresh" content="0; url=index.php" />
