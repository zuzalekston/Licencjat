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
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
</head>
<body>
    <div id="container">
			<div id="imagesBox">
						<form id="imageForm" action="upload.php" method="post" enctype="multipart/form-data" >
						<h2>Dodaj nowy obrazek lub zdjęcie :) </h2>

							Wybierz obrazek: </br>
							<input type="file" name="fileToUpload" id="fileToUpload"> </br></br>


							<div class="form-group">
								<label for="exampleFormControlInput1">Nazwij go:</label>
								<input type="text" name="title" class="form-control" id="exampleFormControlInput1">
							</div>
							</br>

							<div class="form-group">
								<label for="exampleFormControlTextarea1">Dodaj opis:</label>
								<textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							</br>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								<label class="form-check-label" for="defaultCheck1">
									ukryta galeria
								</label>
							</div>


							<button type="submit" name="dodajButton" class="btn btn-primary mb-2">Dodaj</button>
						</form>

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