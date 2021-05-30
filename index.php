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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="shortcut icon" href="arbuz.png">
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

<body>


<!-- Top Navigation Menu -->
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
						<!--Navbar-->
			
			<div class="imagesBox" class="gallery">
				<?php
$query = "SELECT i.id, i.title, i.text, i.image, i.type FROM images as i JOIN users as u ON i.id_user = u.id WHERE i.is_public = 1 AND username = '" . $_SESSION['userLoggedIn'] . "' ORDER BY i.id DESC;";
$images = mysqli_query($con, $query);
//$id_image = $_GET['id_image'];

while ($row = mysqli_fetch_array($images))  {
    echo "<div id='imageDiv'>";
    echo "<a href='single.php?id=" . $row['id'] . "'>";
    echo "<img id='image' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' class='img-fluid' alt='Responsive image'>";
    echo "<div id='hide'>";
    echo "<p class='hiddenText'>" . $row['title'] . "</p>";
    //echo "<p clsss='hiddenText'>".$row['text']."</p>";
    echo "</div>";
    echo "</a>";
    //echo "</br>";

    /*if($row['text'] != NULL){
    echo "<p>" . $row['text'] . "</p>";
    }

    echo "<a id='zmien' href='zmien.php?id_image=" . $row['id'] . "'>edytuj</a>";
    echo "    ";
    echo "<a id='usun' href='usun.php?id_image=" . $row['id'] . "'>usuń</a>";

    echo "</br></br>"; */
    echo "</div>";
}
?>
			</div>

			<div id="nav">
				<div id="navText">
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a id="activePage" class="menuText" href="index.php">MOJA GALERIA</a></p>
					<p class="menu"><a id="ukryta" href="hiddengallery.php">UKRYTA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>

					<p class="menu" style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			</div>
	</div>

	<script>
		//var masonry = new Macy({
  		//	container: 'div.gallery',
		//	columns: 4,
		//});
        var masonry = new Macy({
            container: '.imagesBox',
            trueOrder: false,
            waitForimages: true,
            useOwnImageLoader: false,
            debug: true,
            mobileFirst: true,
            columns: 4,
			breakAt: {
				400: 1,
				500: 2,
				700: 3,
				1100: 4,
			},
			margin: {
				x: 10,
				y: 10,
			}
        });

	</script>
</body>
</html>