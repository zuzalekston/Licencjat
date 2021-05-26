<html>
<head>
    <title>Grafi</title>
    <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
    <link rel="shortcut icon" href="arbuz.png">
</head>
    <body>
        <?php
include "includes/config.php";
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

if (isset($_POST['isPublicButton'])) {
    //zapisz button was pressed
    $idImage = $_GET['id'];
    $query = "UPDATE images SET is_public = 1 WHERE id= $idImage";
    $result = mysqli_query($con, $query);
}
echo '<meta http-equiv="refresh" content="0; url=hiddengallery.php"/>';
?>

    </body>
</html>