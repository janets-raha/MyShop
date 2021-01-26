
<?php
session_start();
require_once("connexionToDatabase.php");

    if(isset($_SESSION['Pseudo']))
        {
            echo "<h2>Bonjour admin " . implode("", array($_SESSION['Pseudo'])) . " !</h2><br /><br />";

        }
    echo "<p><a href='admin_logout.php' >Deconnexion Admin</a></p>";

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

    <head>
    
    <link rel="stylesheet" type="text/css" href="styleadmin.css">
        <meta charset="utf-8">
        <title>Gestion des membres et des produits</title>
    </head>
    <body>
        <?php include("navbar.php"); ?>
        <h4><strong>Tableau de bord Admin</strong></h4>
        <div class="accueilAdmin">
            <ul>
            <li><a href="showAllUsers.php" class="button"><span class="lens">Liste de tous les utilisateurs</span></a></li><br>
            <li><a href="showAllUsers.php" class="button"><span class="user">Modifier le compte d'un membre</span></a></li><br>
            <li><a href="showAllUsers.php" class="button" ><span class="delete">Suppression du compte d'un membre</span></a></li><br>
            <li><a href="createProduct.php" class="button"><span class="add">Ajouter un produit</a></li><br>
            <li><a href="showllAllProducts.php" class="button"><span class="lens">Afficher tous les produits</span></a></li><br>
            <li><a href="editOneProduct.php" class="button"><span class="info">Modifier un produit</span></a></li><br>
            <li><a href="deleteProduct.php" class="button"><span class="delete">Supprimer un produit</span></a></li><br>
            </ul>
    </div>  
    </body>
       
    <footer><div class="footer"><b><h3>Fruities © 2020</h3></b><div></footer>
</html>
