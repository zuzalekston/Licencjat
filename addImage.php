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
	<!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script>
		function myFunction() {
			var x = document.getElementById("myLinks");
			if (x.style.display === "block") {
				x.style.display = "none";
			} else {
				x.style.display = "block";
			}
		}
	</script>
</head>
<body>
	<div class="topnav">
	<?php echo "<p ><a href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
	<!-- Navigation links (hidden by default) -->
	<div id="myLinks">
		<a href="index.php">MOJA GALERIA</a>
		<a id="ukryta" href="hiddengallery.php">UKRYTA GALERIA</a>
		<a href="obserwowane.php">OBSERWOWANE</a>
		<a href="obserwuj.php">OBSERWUJ</a>
		<a href="addImage.php">DODAJ OBRAZEK</a>
		<a href="ustawienia.php">USTAWIENIA</a>

		<p style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
		<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
	</div>
	<!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
		<i class="fa fa-bars"></i>
	</a>
	</div>
    <div id="container">
			<div class="imagesBox" id="background" >
				<div class="opacity">
						<form id="imageForm" action="upload.php" method="post" enctype="multipart/form-data" >
						<h2>Dodaj nowy obrazek lub zdjęcie :) </h2>

							Wybierz obrazek: </br>
							<input type="file" name="fileToUpload" id="fileToUpload" required> </br></br>


							<div class="form-group">
								<label for="exampleFormControlInput1">Nazwij go:</label>
								<input type="text" name="title" class="form-control" id="exampleFormControlInput1" maxlength="50">
							</div>
							</br>

							<div class="form-group">
								<label for="exampleFormControlTextarea1">Dodaj opis:</label>
								<textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="2" maxlength="200"></textarea>
							</div>
							</br>
							<p>Domyślnie zdjęcia są dodawane do Ukrytej Galerii</p>
							<div class="form-check">
								<input class="form-check-input" name="isPublic" type="checkbox" value="1" id="defaultCheck1">

									Moja Galeria

							</div>


							<button type="submit" name="dodajButton" class="btn btn-primary mb-2">Dodaj</button>
						</form>
				</div>

			</div>
			<div id="nav">
				<div id="navText">
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a class="menuText" href="index.php">MOJA GALERIA</a></p>
                    <p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
                    <p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a id="activePage" class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>

					<p class="menu"  style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			</div>

	</div>

</body>
</html>