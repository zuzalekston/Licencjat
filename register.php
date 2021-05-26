<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);  //?

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Grafi</title>
	<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<link rel="shortcut icon" href="arbuz.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php

	if(isset($_POST['registerButton'])) {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
	}
	else {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
	}

	?>
	

	<div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2 style="text-shadow: 2px 2px #000;">Zaloguj się</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Login</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="np. zuzalek100" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<label for="loginPassword">Hasło</label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Twoje hasło" required>
					</p>

					<button type="submit" name="loginButton">ZALOGUJ</button>

					<div class="hasAccountText">
						<span id="hideLogin" >Nie masz konta? Zarejestruj się tu!</span>
					</div>
					
				</form>



				<form id="registerForm" action="register.php" method="POST">
					<h2>Zarejestruj się</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="username">Login</label>
						<input id="username" name="username" type="text" placeholder="np. zuzalek100" value="<?php getInputValue('username') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="firstName">Imię</label>
						<input id="firstName" name="firstName" type="text" placeholder="np. Zuzanna" value="<?php getInputValue('firstName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Nazwisko</label>
						<input id="lastName" name="lastName" type="text" placeholder="np. Lekston" value="<?php getInputValue('lastName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" placeholder="zuzalekston@gmail.com" value="<?php getInputValue('email') ?>" required>
					</p>

					<p>
						<label for="email2">Powtórz email</label>
						<input id="email2" name="email2" type="email" placeholder="zuzalekston@gmail.com" value="<?php getInputValue('email2') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<label for="password">Hasło</label>
						<input id="password" name="password" type="password" placeholder="Twoje hasło" required>
					</p>

					<p>
						<label for="password2">Powtórz hasło</label>
						<input id="password2" name="password2" type="password" placeholder="Twoje hasło" required>
					</p>

					<button type="submit" name="registerButton">ZAREJESTRUJ SIĘ</button>

					<div class="hasAccountText">
						<span id="hideRegister">Masz już konto? Zaloguj się tu.</span>
					</div>
					
				</form>


			</div>

			<div id="loginText">
				<h1 style="font-size: 45px; text-shadow: 2px 2px #000;">Masz piękne zdjęcia i chcesz się nimi podzielić?</h1>
				<h2 style="padding-bottom:-10px;">Publikuj zdjęcia i obrazki w Grafi!</h2>
				<ul style="padding-left:3em">
					<li style="padding-left:0.5em"><span>Używaj serwisu zupełnie za darmo</span></li>
					<li style="padding-left:0.5em"><span>Dodawaj ulubione zdjęcia</span></li>
					<li style="padding-left:0.5em"><span>Udostępniaj swoje obrazki</span></li>
				</ul>
			</div>

		</div>
	</div>

</body>
</html>