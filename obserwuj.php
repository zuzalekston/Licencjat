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
	<script src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
</head>

<body>
    <div id="container">
			<div id="imagesBox">
				<table class="table table-hover table-dark">
				<h2 style="padding-top: 30px">Wybierz osoby, które chcesz zaobserwować</h2>
					<thead>
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
									<td style='width:20%'> <?=$zmienna?></td>
									<td style='width:30%'><?=$row['username']?></td>
									<td>
									<?php echo "<a id='udostepnij' href='udostepnij.php?id=" . $userId . "&id_watched=" . $row['id'] . "'>obserwuj</a>"; ?>
									</td>
								</tr>
					<?php
							} else {
					?>
								<tr>
									<td style='width:20%'> <?=$zmienna?></td>
									<td style='width:30%'><?=$row['username']?></td>
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