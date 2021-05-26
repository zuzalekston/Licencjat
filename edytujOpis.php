<?php
include "includes/config.php";

//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

?>

<html>
<head>
	<title>Grafi</title>
	<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="shortcut icon" href="arbuz.png">
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>

</head>

<body>
    <?php
$username = $_SESSION['userLoggedIn'];
if (isset($_POST['zmienButton'])) {
    //zmien button was pressed
    //UPDATE `users` SET `aboutUser` = 'tutaj jest dość długi opis...' WHERE `users`.`id` = 7;
    $query = "UPDATE users SET aboutUser = '" . $_POST['text'] . "' WHERE username='" . $username . "';";
    echo $query;

    $result = mysqli_query($con, $query);

    if ($result == true) {
        // $_SESSION['userLoggedIn'] = $username;
        header("Location: user.php?username=" . $username);
    }

}

if (isset($_POST['anulujButton'])) {
    header("Location: user.php?username=" . $username);
}
?>



	<div id="container">
			<div id="user" style="width: 80%">
				<div id="aboutUser" style ="color: white; padding: 20px 0 20px 30px;">
					<?php
$query = "SELECT aboutUser FROM users WHERE username = '$username';";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_row($result);
echo "<p style='font-size: 32px'; padding-bottom: 10px;>" . $username;

?>
				</div>

				<div class="imagesBox" style = "width:100%; padding: 20px 0 0 30px;">
                    <form id="zmienForm" action="edytujOpis.php?username=<?php echo $username; ?>" method="POST">
                            <div class="form-group">
                                    <label for="exampleFormControlTextarea1">edytuj opis:</label>
                                    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="2" maxlength="200">
                                        <?php echo $row[0]; ?>
                                    </textarea>
                            </div>
                        <button type="submit" name="zmienButton" class="btn btn-primary mb-2">Zapisz</button>
                        <button type="submit" name="anulujButton" class="btn btn-primary mb-2">Anuluj</button>


                    </form>

				</div>
			</div>
			<div id="nav">
				<div id="navText">
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a class="menuText" href="index.php">MOJA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>

					<p class="menu"  style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			</div>
	</div>
</body>
</html>