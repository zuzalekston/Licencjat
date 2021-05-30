<?php
include "includes/config.php";
include "includes/classes/Account.php";
include "includes/classes/Constants.php";

$account = new Account($con);

//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$userId = $_SESSION['userId'];

if (isset($_POST['hasloButton'])) {
    //zapisz button was pressed

    $stare = $_POST['stareHaslo'];
    $nowe = strip_tags($_POST['noweHaslo']);
    $nowe2 = strip_tags($_POST['powtorzNoweHaslo']);

    $wasSuccessful = $account->changePassword($userLoggedIn, $stare, $nowe, $nowe2);

    if ($wasSuccessful == true) {
        alert("Hasło zostało zmienione.");
    } else {
        /*$account->getError(Constants::$passwordsDoNoMatch);
        echo $account->getError(Constants::$passwordNotAlphanumeric);
        echo $account->getError(Constants::$passwordCharacters);
        echo $account->getError(Constants::$wrongOldPassword); */
        alert($account->getLastError());
    }
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
			<div class="imagesBox" id="background">
				<div class="opacity">
					<form id="registerForm" action="ustawienia.php" method="POST">
					<h2>Zmień hasło</h2>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-2 col-form-label">Stare hasło</label>
							<div class="col-sm-10">
								<input type="password" name="stareHaslo" class="form-control" id="inputPassword3" placeholder="stare hasło">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-2 col-form-label">Nowe hasło</label>
							<div class="col-sm-10">
								<input type="password" name="noweHaslo" class="form-control" id="inputPassword3" placeholder="nowe hasło">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-2 col-form-label">Powtórz nowe hasło</label>
							<div class="col-sm-10">
								<input type="password" name="powtorzNoweHaslo" class="form-control" id="inputPassword3" placeholder="powtórz nowe hasło">
							</div>
						</div>

						<button type="submit" name="hasloButton" class="btn btn-primary mb-2">Zapisz</button>
					</form>
				</div>
			</div>
			<div id="nav">
				<div id="navText">
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a class="menuText" href="index.php">MOJA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a id="activePage" class="menuText" href="ustawienia.php">USTAWIENIA </a></p>

					<p class="menu"  style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			</div>
	</div>
</body>
</html>