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
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>

</head>

<body>
	<div id="container">
			<div id="imagesBox" class="gallery">
				<?php
                $idImage = $_GET['id'];
				$query = "SELECT * FROM Images where id = $idImage;";
				$images = mysqli_query($con, $query);
				//$id_image = $_GET['id_image'];

				while ($row = mysqli_fetch_array($images)) { ?>
					<div id='singleImageDiv'>
						
                        <div class = "singleImages">
                            <?php echo "<img id='singleImage' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' class='img-fluid' alt='Responsive image'>"; ?>
                        </div>
                        <div class ="aboutImage">
							<div id="opis">
								<?php echo "<h3>" . $row['title'] . "</h3>"; ?>
								<p>Opis:
								<?php echo $row['text']."</p>" ?>
								<?php echo "<a id='zmien' href='zmien.php?id_image=" . $row['id'] . "'>edytuj</a>";
								echo "    ";
								echo "<a id='usun' href='usun.php?id_image=" . $row['id'] . "'>usuń</a>"; ?>
							</div>
							<div id="komentarze">
								<p>Komentarze:</p>
							</div>
                        </div>

					</div>
                <?php
						//echo "</br>";

						/*if($row['text'] != NULL){
						echo "<p>" . $row['text'] . "</p>";
						}

						echo "<a id='zmien' href='zmien.php?id_image=" . $row['id'] . "'>edytuj</a>";
						echo "    ";
						echo "<a id='usun' href='usun.php?id_image=" . $row['id'] . "'>usuń</a>";

						echo "</br></br>"; */
					
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