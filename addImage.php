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
</head>
<body>
    <div id="container">
		<div id="head">
			<div id="user">
				<p id="username">
					<?php echo $_SESSION['userLoggedIn'];
echo "</br>"; ?>
				</p>

			</div>

			<div id="headBox">
				<p id="headText">
					Grafi
				</p>
			</div>


		</div>

		<div id="rest">
			<div id="nav">
				<div id="navText">
					<p id="szukaj">Witaj w Grafi!</p>
					<p class="menu"><a class="menuText" href="index.php">Moje obrazki</a></p>
                    <p class="menu"><a class="menuText" href="shared.php">Udostępnione dla mnie</a></p>
                    <p class="menu"><a class="menuText" href="shareTo.php">Udostępnij</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">Dodaj obrazek</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>


			</div>

			<div id="imagesBox">
				<div id="dodaj_obrazek">

					<h2>Dodaj nowy obrazek lub zdjęcie :) </h2>

						<form action="upload.php" method="post" enctype="multipart/form-data">

							Wybierz obrazek:
							<input type="file" name="fileToUpload" id="fileToUpload"> </br></br>
							Nazwij go:
							<input type="text" name="title">
							</br></br>
							<input type="submit" value="Dodaj" name="submit">
						</form>
				<div>

			</div>

		</div>

	</div>

</body>
</html>