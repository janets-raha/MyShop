<!DOCTYPE html>
<html>
<head><link rel="stylesheet" type="text/css" href="styleadmin.css"></head>
<body>
    <?php include("navbar.php"); ?>

<header><img src="https://i.postimg.cc/yx6KGKCF/logo.png" ></header><br><br>
   
<button onclick="location='createProduct.php'">Ajouter un fruit</button> 

     
<?php 

    if(!isset($_SESSION['Pseudo'])) {
        header("location:index.php");
    } else
    {
        echo "<p><a href='admin_logout.php'>Logout admin</a></p>";
    }

   include_once("db_crud.php");

    $displayProduct = new Crud();
    $stmt = $displayProduct->getProduct();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>
                    <a href="updateProduct.php?id=<?= $row['id'] ?>">
                    <input type='submit' name='id' value='modifier'></a>
                    <a href="deleteProduct.php?delete=<?php echo $row['id'] ?>">
                    <input type='submit' name='delete' value='supprimer'></a>
                </td>
            </tr>
    <?php endwhile; ?>


</body><br><br>
<footer><div class="footer"><b><h3>Fruities © 2020</h3></b><div></footer>
</html>