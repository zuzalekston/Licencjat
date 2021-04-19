<?php

if(isset($_POST['szukajButton'])) {
	//szukaj button was pressed
	$szukany = $_POST['search_user'];



?>

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
				<?php
					//$userId = mysqli_query($con, "SELECT id FROM Users WHERE username = '".$_SESSION['userLoggedIn']."'");
					//echo $userId;

					$id_image = $_GET['id_image'];
					
					$username = $_SESSION['userLoggedIn'];

					
						echo "<p class='pageTitle'>udostępnione dla mnie</p></br>";

						echo "<div id='searched_user'>";
						echo "<a id='szukaj_ponownie' href='shared.php'>Kliknij tu, aby wyszukać jeszcze raz</a></br></br>";
						echo "Wybierz użytkownika, którego obrazki chcesz zobaczyć:";
						echo "</br>";
						$result = mysqli_query($con, "SELECT *FROM Users WHERE username LIKE '%{$szukany}%';");

						while ($row = mysqli_fetch_array($result)) {
							echo "<a class='szukany_user' href='szukany_user.php?username=".$row['username']."'>".$row['username']."</a>";
							echo "</br>";
						}

					echo "</div>";
				
					
				}
				?>
			
			
			</div>
		
		
		
		</div>
	
	
	</div>



</body>

</html>