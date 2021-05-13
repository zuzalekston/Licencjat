<?php
include "includes/config.php";

//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

include "szukaj.php";
?>
<html>
<head>
	<title>Grafi</title>
	<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
</head>

<body>
	<div id="container">
			<div id="imagesBox">
				<?php
					$id_image = $_GET['id_image'];

					$username = $_SESSION['userLoggedIn'];
					$userId = $_SESSION['userId'];
				?>
					<p class='pageTitle'>UDOSTĘPNIONE DLA MNIE</p></br></br>

					<form action="szukaj.php" method="POST">
						<p id="szukaj_po">Szukaj po nazwie użytkownika:
						<input type='text' name='search_user'>

						<button type="submit" name="szukajButton">Szukaj</button></p>
					</form>
					<?php
						$query = "SELECT title, image, type, u.username FROM Images i
																			JOIN Users u on u.id = i.id_user
																			JOIN watched f ON f.id_watched = u.id
																			WHERE f.id_user = $userId
																			ORDER BY i.id DESC";
						$share = mysqli_query($con, $query);

						echo "</br>";
						while ($row = mysqli_fetch_array($share)) {
							echo "<div id='imageDiv'>";
							echo "<img id='image' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' />";
							echo "</br>";
							echo "<p id='imageTitle'>" . $row['title'] . "</p>";
							echo "<p id='nazwa_udost'>" . $row['username'] . "</p>";
							echo "</div>";
						}

					?>
			</div>
			<div id="nav">
				<div id="navText">
					<p id="headText"><a id="userHref" href="user.php"><?php echo $_SESSION['userLoggedIn'] ?></a></p>
					<p class="menu"><a class="menuText" href="index.php">MOJE OBRAZKI</a></p>
					<p class="menu"><a class="menuText" href="hiddengallery.php">UKRYTA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>

			</div>
	</div>
</body>

</html>