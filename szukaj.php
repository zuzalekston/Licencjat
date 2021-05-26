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
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>

</head>

<body>
	<div id="container">
			<div class="imagesBox" class="szukajBox">
				<?php
//$userId = mysqli_query($con, "SELECT id FROM users WHERE username = '".$_SESSION['userLoggedIn']."'");
//echo $userId;

if (isset($_POST['szukajButton'])) {
    //szukaj button was pressed
    $szukany = $_POST['search_user'];

    $id_image = $_GET['id_image'];
    $username = $_SESSION['userLoggedIn'];

    echo "<div id='searched_user'>";
    echo "<p>Szukaj ponownie:</p>";?>
										<form action="szukaj.php" method="POST" class="form-inline">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">@</span>
												</div>
												<input type="text" name='search_user' class="form-control" placeholder="Nazwa użytkownika" aria-label="Username" aria-describedby="basic-addon1">
											</div>

											<button id="szukajButton" type="submit" name="szukajButton" class="btn btn-primary mb-2">Szukaj</button>
										</form>
										<?php echo "<p>Wyszukana fraza: <b>$szukany</b></p>";
    echo "<p id='szukaj_ponownie'>Pasujące nazwy użytkowników:</p>";

    $result = mysqli_query($con, "SELECT *FROM users WHERE username LIKE '%{$szukany}%';");

    while ($row = mysqli_fetch_array($result)) {
        echo "<a class='szukany_user' href='user.php?username=" . $row['username'] . "'>" . $row['username'] . "</a>";
        echo "</br>";
    }
    echo "</div>";
} else {
    ?>
										<form action="szukaj.php" method="POST" class="form-inline" style="padding: 20px 0 0 30px;">
											<p>Wyszukaj użytkownika po nazwie:</p>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">@</span>
												</div>
												<input type="text" name='search_user' class="form-control" placeholder="Nazwa użytkownika" aria-label="Username" aria-describedby="basic-addon1">
											</div>

											<button id="szukajButton" type="submit" name="szukajButton" class="btn btn-primary mb-2">Szukaj</button>
										</form>

										<?php
}
?>
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