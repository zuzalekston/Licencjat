<?php
include "includes/config.php";

//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$userId = $_SESSION['userId'];

if (isset($_POST['hasloButton'])) {
    //zapisz button was pressed
    $stare = md5($_POST['stareHaslo']);
    $nowe = md5($_POST['noweHaslo']);
    //echo $_POST['title'];
    //echo $_POST['id_image'];
    $query = "SELECT * FROM Users WHERE id = $userId;";
    echo $query;

    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) != 1) {

        alert("Wstąpił błąd.");

    } else {
        $row = mysqli_fetch_row($result);
        if ($row[5] == $stare) {

            //$query2 = "UPDATE Users SET users.password = '$nowe' WHERE id = $userId;";
            $query2 = "UPDATE `users` SET `password` = '$nowe' WHERE `users`.`id` = $userId;";
            echo $query2;
            $result2 = mysqli_query($con, $query2);

            if ($result2 == true) {
                echo 1;
            }
        } else {
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
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
</head>
<body>
	<div id="container">
			<div id="imagesBox">
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