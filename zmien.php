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

if (isset($_POST['zmienButton'])) {
    //zmien button was pressed
    //$title = $_POST['title'];
    //$id_image = $_POST['id_image'];
    //echo $_POST['title'];
    //echo $_POST['id_image'];
    $query = "UPDATE images SET title = '" . $_POST['title'] . "', text = '" . $_POST['text'] . "' WHERE id=" . $_GET['id_image'] . ";";
    echo $query;

    $result = mysqli_query($con, $query);

    if ($result == true) {
        // $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }

}

if (isset($_POST['anulujButton'])) {
    header("Location: index.php");
}

$id_image = $_GET['id_image'];

$images = mysqli_query($con, "SELECT * FROM images WHERE id = " . $_GET['id_image'] . ";");
$image = mysqli_fetch_array($images);

//echo "<input id='title' type='text' value='".$image['title']."'>";
//<meta http-equiv="refresh" content="0; url=index.php" />

?>

    <form id="zmienForm" style="padding: 20px" action="zmien.php?id_image=<?php echo $id_image; ?>" method="POST">
            <h2>Edytuj</h2>

                <div class="form-group" style="margin-bottom: 2%; margin-top:1%">
                        <label for="exampleFormControlInput1">Zmień nazwę:</label>
                        <input type="text" name="title" class="form-control" id="text" value='<?php echo $image["title"]; ?>'>
                </div>

                <div class="form-group">
						<label for="exampleFormControlTextarea1">Zmień opis:</label>
						<textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3" >
                            <?php echo $image["text"]; ?>
                        </textarea>
				</div>
            <button type="submit" name="zmienButton" class="btn btn-primary mb-2">Zapisz</button>
            <button type="submit" name="anulujButton" class="btn btn-primary mb-2">Anuluj</button>


	</form>
    </body>

</html>