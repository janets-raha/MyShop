<!DOCTYPE html>
<html>
<head><link rel="stylesheet" type="text/css" href="styleadmin.css"></head>
<body>
    <?php include("navbar.php"); ?>
<header><img src="https://i.postimg.cc/yx6KGKCF/logo.png" ></header><br>
<?php 
    if(!isset($_SESSION['Pseudo'])) {
        header("location:index.php");
    } else
    {
        echo "<p><a href='admin_logout.php'>Logout admin</a></p>";
    }
    
    include_once("db_crud.php");
    include_once("product.php");
    include_once("category.php");

    if(isset($_POST["submit"])) {
        
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $cat_name = $_POST["category"];


        $fileName = $_FILES["image"]["name"];
        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileSize = $_FILES["image"]["size"];
        $fileError = $_FILES["image"]["error"];
        $fileType = $_FILES["image"]["type"];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");


        if((strlen($name)<3 || strlen($name)>15)) {
            echo "Le nom doit contenir entre 3 à 15 characteres" . "\n";
        } elseif(empty($cat_name)) {
            echo "Choisissez une catégorie."; 
        } elseif(strlen($description)<5) {
            echo "La description est trop courte." . "\n";
        } elseif(!in_array($fileActualExt, $allowed)) {
            echo "Choisissez un fichier de type jpg, jpeg ou png !";
        } elseif($fileError === 1) {
            echo "Une erreur s'est produite lors du chargement du fichier !";
        } elseif($fileSize > 500000) {
            echo "Le fichier est trop lourd !";
        } else {
            $fileNameNew = uniqid("",true) . "." . $fileActualExt;
            $fileDestination = "images/" . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
    ///     header('Location: index.php?uploadsuccess'); insert in final version                        
            $product = new Product($name, $description, $fileDestination, $price);
            $category = new Category($cat_name);
            $new_product = new Crud();
            $new_product->setProduct($product, $category);
        }
    }  
?>

    <form action='createProduct.php' method='post' enctype="multipart/form-data" target='_self'>
    <label for='name'>Nom du fruit</label><br>
    <input type='text' id='name' name='name' placehoder='my_product'><br>
    <label for="category">Choisissez une categorie:</label>
    <select id="category" name="category">
        <option value="">Categories</option>
        <option value="Agrumes">Agrumes</option>
        <option value="Fruits à noyau">Fruits à noyau</option>
        <option value="Fruits rouges">Fruits rouges</option>
        <option value="Fruits exotiques">Fruits exotiques</option>
    </select><br>
    <label for='description'>Description du fruit</label><br>
    <textarea id='description' name="description" rows="10" cols="30"></textarea><br><br>
    <label for="image">Importer une nouvelle photo</label>
    <input type="file" id="image" name="image" ><br>
    <label for="price">Prix</label><br>
    <input type='number' id='price' name='price' placehoder='prix'><br>
    <input type='submit' name='submit' value='Valider'><br>
    </form>

</body><br><br>

<footer><div class="footer"><b><h3>Fruities © 2020</h3></b><div></footer>
</html>
