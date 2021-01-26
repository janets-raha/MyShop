<?php
session_start();
require_once("adminClass.php");

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
    $retrieve_user_infos = connexionToDatabase()->prepare("SELECT username, email, admin FROM users WHERE id = :id");
    $retrieve_user_infos->execute(array(
        "id" => $getid
    ));
    $display_user = $retrieve_user_infos->fetch();

    if (isset($_POST['modify']))
    {
        Admin::editOneUser();

        header("Location: showAllUsers.php");
    }

}
else
{
    echo "Ce membre n'existe pas !<br />";
}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Modifier un membre - Administration</title>
    </head>
    <body>
        <?php include("navbar.php"); ?>
        <h3>Formulaire de modification des informations de connexion.<br /></h3>
        <form action="" method="post">
            Pseudo <input type="text" name="nom_modif" value="<?= $display_user['username']; ?>" ><br>
            Email  <input type="text" name="email_modif" value="<?= $display_user['email']; ?>"><br>
            Status du membre <input type="text" name="status_admin" value="<?= $display_user['admin']; ?>"><br><br>
            <input type="submit" name="modify" value="Je modifie">
        </form><br><br><br>

    </body>
</html>
