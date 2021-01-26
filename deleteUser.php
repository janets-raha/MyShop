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

if (isset($_GET['id']) AND !empty($_GET['id']))
{
    $getid = $_GET['id'];

    Admin::deleteUser();

    echo "<p><a href='showAllUsers.php'>Retourner à la liste des membres</a></p>";
}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Suppression d'un membre - Administration</title>
    </head>
    <body>

    </body>
</html>
