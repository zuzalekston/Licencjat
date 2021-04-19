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
							  JOIN Friends f ON f.id_user = u.id
							  WHERE f.id_friend = $userId";
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
		</div>
	</div>
</body>

</html>