<?php
require_once("adminClass.php");
session_start();

if(!$_SESSION['Pseudo'])
{
    header("Location: index.php");
}
else
{ 
    echo "<p><a href='admin_logout.php'>Logout admin</a></p>";
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Membres - Administration</title>
    </head>
    <body>
        <?php include("navbar.php"); ?>
        <h3>Les données de toutes les personnes qui ont un compte sur notre site internet.</h3><br>
        <?php Admin::showAllUsers(); ?>
    </body>
</html>
