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
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
</head>

<body>
    <div id="container">
			<div class="imagesBox" id="background">
				<div class="opacity">
					<h3 style="padding: 20px 0 0 30px">Wybierz osoby, które chcesz zaobserwować</h3>

					<form action="szukaj.php" method="POST" class="form-inline" style="padding: 20px 0 0 30px;">
							<div class="input-group" style="width:300px;">
								<div class="input-group-prepend" >
									<span class="input-group-text" id="basic-addon1">@</span>
								</div>
								<input type="text" name='search_user' class="form-control" placeholder="Nazwa użytkownika" aria-label="Username" aria-describedby="basic-addon1" >
							</div>

							<button id="szukajButton" type="submit" name="szukajButton" class="btn btn-primary mb-2">Szukaj</button>
					</form>
					<div class="table-wrapper-scroll-y my-custom-scrollbar">
						<table class="table table-hover table-dark">
							<thead style="padding-top:10px;">
								<tr>
									<th scope="col" style='width:20%'></th>
									<th scope="col" style='width:30%'>Użytkownik</th>
									<th scope="col">OBSERWUJ</th>
								</tr>
							</thead>
							<tbody>
							<?php
$username = $_SESSION['userLoggedIn'];
$userId = $_SESSION['userId'];
$query = "SELECT u.id, u.username, f.id_watched FROM users u LEFT JOIN watched f ON u.id = f.id_watched WHERE u.id != $userId";

$zmienna = 1;
$share = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($share)) {
    if ($row['id_watched'] == null) {
        ?>
																<tr>
																	<td style='width:20%'><?=$zmienna?></td>
																	<?php echo "<td style='width:30%'><a style='text-decoration:none; color:white;' href='user.php?username=" . $row['username'] . "'>" . $row['username'] . "</a></td>"; ?>
																	<td>
																	<?php echo "<a id='udostepnij' href='zaobserwuj.php?id=" . $userId . "&id_watched=" . $row['id'] . "'>obserwuj</a>"; ?>
																	</td>
																</tr>
													<?php
} else {
        ?>
																<tr>
																	<td style='width:20%'> <?=$zmienna?></td>
																	<?php echo "<td style='width:30%;'><a style='text-decoration:none; color:white;' href='user.php?username=" . $row['username'] . "'>" . $row['username'] . "</a></td>"; ?>
																	<td><?php echo "<a id='skoncz' href='skoncz.php?id=" . $userId . "&id_watched=" . $row['id'] . "'>skończ obserwować</a>"; ?></td>
																</tr>
													<?php
}
    $zmienna = $zmienna + 1;
}
?>
								</tbody>
						</table>
					</div>
				</div>
			</div>
			<div id="nav">
				<div id="navText">
				<?php echo "<p id='headText'><a id='userHref' href='user.php?username=" . $_SESSION['userLoggedIn'] . "'>" . $_SESSION['userLoggedIn'] . " </a></p>"; ?>
					<p class="menu"><a class="menuText" href="index.php">MOJA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a id="activePage" class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>

					<p class="menu"  style="color:#a0a0a0; font-size:14px; padding-top:20px;"><a id="skoncz" href="serwis.php">O serwisie</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>

			</div>
	</div>

</body>
</html>