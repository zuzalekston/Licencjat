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
					<p class="menu"><a class="menuText" href="hiddengallery.php">Ukryta galeria</a></p>
					<p class="menu"><a class="menuText" href="shared.php">Obserwowane</a></p>
					<p class="menu"><a class="menuText" href="shareTo.php">Obserwuj</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">Dodaj obrazek</a></p>
					<p class="menu"><a class="menuText" href="settings.php">Ustawienia</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>


			</div>

			<div id="imagesBox">
            </div>

</body>
</html>