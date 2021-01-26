<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/connexionToDatabase.php");

if (isset($_POST['validation']))
{
    if (!empty($_POST['Pseudo']) AND !empty($_POST['Email']) AND !empty($_POST['Password']))
    {
        $request = connexionToDatabase()->prepare('SELECT username, password, email, admin FROM users WHERE email = :email '); //query pour récupérer le password de la database.
        $request->execute(array(
            "email" => $_POST['Email']
        ));
        $reponse = $request->fetch(PDO::FETCH_ASSOC); // $reponse constitue les champs qui sont dans la database; ici, juste l'email.

        if (!$reponse)
        {
            echo "Ce compte n'existe pas !<br />";
        }
        else if (!password_verify($_POST['Password'], $reponse['password']))
        {
            echo "Mot de passe incorrect !<br />";
        }
        else if ($_POST['Email'] != $reponse['email'])
        {
            echo "Adresse email incorrecte !<br />";
        }
        else if ($_POST['Pseudo'] != $reponse['username'])
        {
            echo "Pseudo incorrect !<br />";
        }
        else
        {

            $_SESSION['Pseudo'] = $_POST['Pseudo'];
            $_SESSION['Email'] = $_POST['Email'];

            echo "<h2>Bonjour " . implode("", array($_SESSION['Pseudo'])) . " !</h2><br /><br />";

            $hour = time() + 3600 * 24 * 30;

            setcookie('Pseudo', $_SESSION['Pseudo'], $hour);
            setcookie('Email', $_SESSION['Email'], $hour);
            $_SESSION['remember_me'] = setcookie('Email', $_SESSION['Email'], $hour);

            if ($reponse['admin'] == 1) // si l'utilisateur a 1 comme valeur du status_admin, alors il est un admin et est redirigé vers admin.php
            {
                header ("Location: admin.php");
            }

            echo "<p><a href='admin_logout.php'>Se déconnecter </a></p>";
        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Formulaire de connexion</h2>
</div>

<form method="post" action="">
    <?php // include('errors.php'); ?>
    <div class="input-group">
        <label>Pseudo</label>
        <input type="text" name="Pseudo" >
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="text" name="Email" >
    </div>
    <div class="input-group">
        <label>Mot de passe</label>
        <input type="password" name="Password">
    </div>
    <div >
        <label>Remember me</label>
        <input type="checkbox" name="remember_me"><br>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="validation">Je me connecte</button>
    </div>
    <p>
        Tu n'as pas encore de compte ? <a href="signup.php">Cliques ici</a>
    </p>
</form>
</body>
</html>
