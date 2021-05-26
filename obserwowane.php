<?php
include "includes/config.php";

//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

//include "szukaj.php";
?>
<html>
<head>
	<title>Grafi</title>
	<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="shortcut icon" href="arbuz.png">
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
	<script>
		$(document).ready(function(){
			$(window).scroll(function(){
				if($(this).scrollTop() > 40){
					$('#topBtn').fadeIn();
				} else{
					$('#topBtn').fadeOut();
				}
			});

			$("#topBtn").click(function(){
				$('html,body').animate({scrollTop : 0},800);
			});
		});
	</script>
</head>

<body>
	<div id="container">

			<div class="imagesBox" class="gallery">
						<?php
//$id_image = $_GET['id_image'];

$username = $_SESSION['userLoggedIn'];
$userId = $_SESSION['userId'];
?>

							<?php
$query = "SELECT title, image, type, u.username, i.id FROM images i
					JOIN users u on u.id = i.id_user
					JOIN watched f ON f.id_watched = u.id
					WHERE f.id_user = $userId AND i.is_public = 1
					ORDER BY i.id DESC";
$share = mysqli_query($con, $query);?>

						<?php
while ($row = mysqli_fetch_array($share)) {
    echo "<div id='imageDiv'>";
    echo "<a href='single.php?id=" . $row['id'] . "&username=" . $row['username'] . "'>";
    echo "<img id='image' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' class='img-fluid' alt='Responsive image' />";
    echo "<div id='hide'>";

    echo "<b><p clsss='hiddenText'>" . $row['username'] . "</p></b>";
    echo "<p clsss='hiddenText'>" . $row['title'] . "</p>";
    echo "</div>";
    //echo "<p id='imageTitle'>" . $row['title'] . "</p>";
    //echo "<p id='nazwa_udost'>" . $row['username'] . "</p>";
    echo "</a>";
    echo "</div>";
}

?>
<button id="topBtn"><i class="fas fa-angle-up" >TOP</i></button>
			</div>
			<div id="nav" >
				<div id="navText">
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a class="menuText" href="index.php">MOJA GALERIA</a></p>
					<p class="menu"><a id="activePage" class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>
					<form action="szukaj.php" method="POST" class="form-inline">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">@</span>
							</div>
							<input type="text" name='search_user' class="form-control" placeholder="Nazwa użytkownika" aria-label="Username" aria-describedby="basic-addon1">
						</div>

						<button id="szukajButton" type="submit" name="szukajButton" class="btn btn-primary mb-2">Szukaj</button>
					</form>

					<p class="menu"  style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
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