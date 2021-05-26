
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
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a class="menuText" href="index.php">MOJA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">Udostępnione dla mnie</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">Udostępnij</a></p>
					<p class="menu"><a class="menuText" href="addImage">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>

					<p class="menu"  style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>


			</div>

			<div class="imagesBox">

					<p class='pageTitle'>udostępnione dla mnie</p></br>

					<a id="szukaj_ponownie" href="obserwowane.php">Wyszukaj jeszcze raz</a></br>
					<p> Obrazki dostępnione od użytkownika <?php echo $_GET['username']; ?>
					</p></br>

					<?php
$query = "SELECT * FROM images JOIN users ON images.id = users.id WHERE username = '" . $_GET['username'] . "' ORDER BY id_image DESC;";
//echo $query;

$images = mysqli_query($con, "SELECT * FROM images JOIN users ON images.id = users.id WHERE username = '" . $_GET['username'] . "' ORDER BY id_image DESC;");

while ($row = mysqli_fetch_array($images)) {
    echo "<div id='imageDiv'>";

    echo "<img id='image' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' />";
    echo "</br>";
    echo "<p id='imageTitle'>" . $row['title'] . "</p>";

    echo "</br></br></br>";
    echo "</div>";

}

?>



			</div>



		</div>


	</div>



</body>

</html>