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
					<p class="menu"><a class="menuText" href="hiddengallery.php">Ukryta galeria</a></p>
					<p class="menu"><a class="menuText" href="shared.php">Udostępnione dla mnie</a></p>
					<p class="menu"><a class="menuText" href="shareTo.php">Udostępnij</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">Dodaj obrazek</a></p>
					<p class="menu"><a class="menuText" href="settings.php">Ustawienia</a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			

			</div>

			<div id="imagesBox">
                <h2>Wybierz osoby, którym chcesz pokazać swoje obrazki</h2>
				<br/>
				<table class="table table-hover table-dark">
				<thead>
					<tr>
						<th scope="col" style='width:20%'></th>
						<th scope="col" style='width:30%'>Użytkownik</th>
						<th scope="col">Udostępnij</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$username = $_SESSION['userLoggedIn'];
				$userId = $_SESSION['userId'];
				$query = "SELECT u.id, u.username, f.id_friend FROM users u LEFT JOIN friends f ON u.id = f.id_friend WHERE u.id != $userId";
				
				$zmienna = 1;
				$share = mysqli_query($con, $query);
				while($row = mysqli_fetch_array($share)) {
					if($row['id_friend'] == NULL) {
				?>
					<tr>
						<td style='width:20%'> <?= $zmienna ?></td>
						<td style='width:30%'><?= $row['username'] ?></td>
						<td>
						<?php echo "<a id='udostepnij' href='udostepnij.php?id=".$userId."&id_friend=".$row['id']."'>udostępnij</a>"; ?>
						</td>
					</tr>
				<?php 
					}
					else { 
				?>
					<tr>
						<td style='width:20%'> <?= $zmienna ?></td>
						<td style='width:30%'><?= $row['username'] ?></td>
						<td><?php echo "<a id='skoncz' href='skoncz.php?id=".$userId."&id_friend=".$row['id']."'>skończ udostępniać</a>"; ?></td>
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

</body>
</html>