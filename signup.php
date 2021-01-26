<?php
    session_start();
	require_once("createdat.class.php");
	
?>

<!DOCTYPE html>
<html>

<head>
  <title>Inscription</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php include("navbar.php"); ?>
<!-- partie php -->

<?php

include_once('createUser.php');

if(isset($_POST['reg_user'])) {
	$name = $_POST["name"];
	$mail = $_POST["mail"];
	$pass = $_POST["pass"];
	$passConfirmation = $_POST["pass_confirmation"];
	$admin = $_POST["status_admin"];
    $createdat = new Created_at();

	$mail = htmlspecialchars(trim($mail));
	$name = htmlspecialchars(ucfirst(trim($name)));
	$pass = trim($pass);
	$passConfirmation = trim($passConfirmation);


	if(empty($name)) {
		echo "Le champ nom ne peut être vide !<br />";
	} elseif(empty($mail)) {
		echo "Le champ email ne peut être vide !<br />";
	} elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		echo "Email invalide ";
	} elseif(empty($pass)) {
		echo "Le champ mot de passe ne peut être vide !<br />";
	} elseif($pass && empty($passConfirmation)) {
		echo "Confirme ton mot de passe !";
	} elseif($pass != $passConfirmation) {
		echo "Tu as saisis deux mots de passe différents !<br />";
	} else {
		$_SESSION['name'] = $mail;
		$pwd = password_hash($pass, PASSWORD_BCRYPT);
		$user = new User();
        $user->setUser($name, $pwd, $mail, $admin, $createdat);

	}
}

?>

<!-- partie html -->


  <div class="header">
  	<h2>Formulaire d'inscription</h2>
  </div>

  <form method="post" action="signup.php">
  	  <?php /* include('errors.php'); */ ?>
  	<div class="input-group">
  	  <label>Pseudo</label>
  	  <input type="text" name="name" value="">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="mail" value="">
  	</div>
  	<div class="input-group">
  	  <label>Mot de passe</label>
  	  <input type="password" name="pass">
  	</div>
  	<div class="input-group">
  	  <label>Confirme ton mot de passe</label>
  	  <input type="password" name="pass_confirmation">
	</div>
	  <!-- hidden input de admin ou pas -->
	<div>
	  <input type="hidden" name="status_admin" value="1">
	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Je m'inscris</button>
  	</div>
  	<p>
  		Tu as déjà un compte ? <a href="signin.php">Clique moi ;)</a>
  	</p>
  </form>
	</body>
</html>
