
<?php
include("includes/config.php");

//session_destroy(); LOGOUT

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
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
					<p class="menu"><a class="menuText" href="shared.php">Udostępnione dla mnie</a></p>
					<p class="menu"><a class="menuText" href="shareTo.php">Udostępnij</a></p>
					<p class="menu"><a class="menuText" href="addImage">Dodaj obrazek</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			

			</div>

			<div id="imagesBox">
			
					<p class='pageTitle'>udostępnione dla mnie</p></br>

					<a id="szukaj_ponownie" href="shared.php">Wyszukaj jeszcze raz</a></br>
					<p> Obrazki dostępnione od użytkownika <?php echo $_GET['username']; ?>
					</p></br>

					<?php
						$query = "SELECT * FROM Images JOIN Users ON Images.id = Users.id WHERE username = '".$_GET['username']."' ORDER BY id_image DESC;";
						//echo $query;

						$images = mysqli_query($con, "SELECT * FROM Images JOIN Users ON Images.id = Users.id WHERE username = '".$_GET['username']."' ORDER BY id_image DESC;");

						while($row = mysqli_fetch_array($images)) {
							echo "<div id='imageDiv'>";

							echo "<img id='image' src='data:".$row['type'].";base64, ".$row['image']."' />";
							echo "</br>";
							echo "<p id='imageTitle'>".$row['title']."</p>";
							
							echo "</br></br></br>";
							echo "</div>";

						}

					?>
	
			
			
			</div>
		
		
		
		</div>
	
	
	</div>



</body>

</html>