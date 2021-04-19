<html>
<head>
    <title>Grafi</title>
    <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
    <body>
<?php
    include("includes/config.php");
    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }
    else {
        header("Location: register.php");
    }

    if(isset($_POST['zmienButton'])) {
        //zmien button was pressed
        //$title = $_POST['title'];
        //$id_image = $_POST['id_image'];
        //echo $_POST['title'];
        //echo $_POST['id_image'];
        $query = "UPDATE Images SET title = '".$_POST['title']."' WHERE id=".$_GET['id_image'].";";
        echo $query;

        $result = mysqli_query($con, $query);
    
        if($result == true) {
           // $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
        }
    
    }

    if(isset($_POST['anulujButton'])) {
        header("Location: index.php");
    }

    $id_image = $_GET['id_image'];
    echo $id_image;
    $images = mysqli_query($con, "SELECT * FROM Images WHERE id = ".$_GET['id_image'].";");
    $image = mysqli_fetch_array($images);

   
    //echo "<input id='title' type='text' value='".$image['title']."'>";
    //<meta http-equiv="refresh" content="0; url=index.php" />

?>

    <form id="zmienForm" action="zmien.php?id_image=<?php echo $id_image; ?>" method="POST">
					<h2>Zmień nazwę</h2>
					<p>
						<label for="title">Nazwa: </label>
						<input id='title' name='title' type='text' value='<?php echo $image["title"]; ?>'>
                        
					</p>

					<button type="submit" name="zmienButton">Zapisz</button>
                    <button type="submit" name="anulujButton">Anuluj</button>

					
	</form>
    </body>

</html>