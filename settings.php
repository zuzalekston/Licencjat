<?php
include("includes/config.php");


//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$userId = $_SESSION['userId'];

if(isset($_POST['hasloButton'])) {
	//zapisz button was pressed
	$stare = md5($_POST['stareHaslo']);
	$nowe = md5($_POST['noweHaslo']);
	//echo $_POST['title'];
	//echo $_POST['id_image'];
	$query = "SELECT * FROM Users WHERE id = $userId;";
	echo $query;

	$result = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo $stare;
		echo $row['password'];
		if($row['password'] == $stare){
			
			$query2 = "UPDATE Users SET users.password = '$nowe' WHERE id = $userId;";
			echo $query2;
			$result2 = mysqli_query($con, $query);
			if($result2 == true) {
				echo 1;
			}
		} else{
			alert("Stare hasło jest niepoprawne.");
		}
	}
	

	//if($result == true) {
	   // $_SESSION['userLoggedIn'] = $username;
		//header("Location: index.php");
	//}

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
					<p class="menu"><a class="menuText" href="hiddengallery.php">Ukryta galeria</a></p>
					<p class="menu"><a class="menuText" href="shared.php">Udostępnione dla mnie</a></p>
					<p class="menu"><a class="menuText" href="shareTo.php">Udostępnij</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">Dodaj obrazek</a></p>
					<p class="menu"><a class="menuText" href="settings.php">Ustawienia</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>


			</div>
        </div>
		<div id="imagesBox">
			nie działa to zmienianie hasła mimo, że leci do bazy
			<h2>Zmień hasło</h2>
			<form id="registerForm" action="settings.php" method="POST">
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Stare hasło</label>
					<div class="col-sm-10">
						<input type="password" name="stareHaslo" class="form-control" id="inputPassword3" placeholder="Password">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Nowe hasło</label>
					<div class="col-sm-10">
						<input type="password" name="noweHaslo" class="form-control" id="inputPassword3" placeholder="Password">
					</div>
				</div>

				<button type="submit" name="hasloButton" class="btn btn-primary mb-2">Zapisz</button>
			</form>
		</div>
</body>
</html>