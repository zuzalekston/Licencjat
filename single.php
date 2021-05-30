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
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
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


<?php

$idImage = $_GET['id'];
$zapytanie ="SELECT i.id, u.username FROM images i JOIN users u ON i.id_user = u.id WHERE i.id = $idImage";
$wynik = mysqli_query($con, $zapytanie);
$wiersz = mysqli_fetch_row($wynik);
$username = $wiersz[1];

if (isset($_POST['dodajButton'])) {
    //dodaj button was pressed
    $komentarz = $_POST['komentarz'];
    $idLoggedIn = "SELECT id FROM users WHERE username='$userLoggedIn'";
    $result1 = mysqli_query($con, $idLoggedIn);
    $row1 = mysqli_fetch_row($result1);

    $query = "INSERT INTO comments VALUES (NULL, $idImage, $row1[0], '$komentarz')";
    //echo $query;
    $result2 = mysqli_query($con, $query);

    if ($result2 == false) {
        alert("Przepraszamy, coś poszło nie tak. Twój komentarz nie został dodany");
    }

}

?>

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
			<div class="imagesBox" class="gallery">
				<?php
$query = "SELECT * FROM images where id = $idImage;";
$images = mysqli_query($con, $query);
//$id_image = $_GET['id_image'];

while ($row = mysqli_fetch_array($images)) {?>
					<div id='singleImageDiv'>

                        <div class ="aboutImage">
							<div id="opis">
								<?php

    echo "<a id='zmien' href='user.php?username=" . $username . "'>";
    echo "<p style='padding-bottom: 10px; font-size: 24px;'>" . $username . "</a>";
    echo "  &#127817;</p>";
    echo "<h2><b id='singleTitle'>" . $row['title'] . "</b></h2>"; ?>
								<?php echo "<p><b class='singleTitle'>Opis: </b>" . $row['text'] . "</p>";
    if ($username == $_SESSION['userLoggedIn']) {
        echo "<a id='edytujSingle' href='zmien.php?id_image=" . $row['id'] . "'>edytuj</a>";
        echo "    ";
        echo "<a id='usunSingle' href='usun.php?id_image=" . $row['id'] . "'>usuń obraz</a><br><br>";
        if ($row['is_public'] == 0) {
            ?>
									<form method="POST" <?php echo "action='isPublic.php?id=" . $idImage . "'"; ?> >
										<div class="form-check" style="padding-top: 40px;">
											<input name="isPublic" class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
											<label class="form-check-label"  for="defaultCheck1">
												Moja Galeria <button name="isPublicButton" id="isPublicButton" class="btn btn-primary mb-2">zapisz</button>
											</label>
										</div>
									</form>
								<?php
}

    }

    ?>
								<!-- <a id="usunKomentarz" href="obserwowane.php">wróć</a> -->
							</div>


							<form id="commentForm" <?php echo "action='single.php?id=" . $idImage . "'"; ?> method="POST">
								<div class="form-group">
									<label for="exampleFormControlInput1"></label>
									<input type="text" name="komentarz" class="form-control" id="text" placeholder="dodaj komentarz" maxlength="200">
									<button type="submit" name="dodajButton" class="btn btn-primary mb-2">dodaj</button>
								</div>
							</form>

                        </div>
						<div class = "singleimages">
                            <?php echo "<img id='singleImage' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' class='img-fluid' alt='Responsive image'>"; ?>
                        </div>
				<?php }?>
						<div id="pusty">

						</div>
						<div id="comments">

							<p style="font-size: 18px;">Komentarze:</p>
							<?php
$comments = "SELECT comments.id, comment_text, username FROM comments JOIN users ON users.id = comments.id_user WHERE id_image = $idImage";
$result = mysqli_query($con, $comments);
while ($row = mysqli_fetch_array($result)) {
    echo "<p><b id='commentUser'>" . $row['username'] . "</b>";
    echo "<em style='padding-right: 2em;'>" . $row['comment_text'] . "</em>";
    if ($row['username'] == $userLoggedIn) {
        echo "<a id='usunKomentarz' href='usun.php?id_comment=" . $row['id'] . "'>usuń</a></p>";
    } else {
        echo "</p>";
    }
}

?>
						</div>

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