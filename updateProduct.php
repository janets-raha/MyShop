<!DOCTYPE html>
<html>
<head><link rel="stylesheet" type="text/css" href="styleadmin.css"></head>
<body>
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
    
    $productname = "";
    $description = "";
    $category = "";
    $image = "";
    $price = ""; 

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = new Crud();
        $stmt = $update->getProductAndCategory($id);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $productname = $product['productname'];
        $description = $product['description'];
        $category = $product['categoryname'];
        $image = $product['image'];
        $price = $product['price'];
    } 
    
    if(isset($_POST['submit'])) {
        //$id = $_POST['id'];
        $name = $_POST["name"];
        $description = $_POST["description"];
    //    $image = $_FILES["image"];   
        $price = $_POST["price"];
        $cat_name = $_POST["category"];

        $fileName = $_FILES["image"]["name"];
        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileSize = $_FILES["image"]["size"];
        $fileError = $_FILES["image"]["error"];
        $fileType = $_FILES["image"]["type"];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png", "");

        if((strlen($name)<3 || strlen($name)>15)) {
            echo "Le nom doit contenir 3 à 15 characteres" . "\n";
        } elseif(strlen($description)<5) {
            echo "La description est trop courte" . "\n";
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
            $product = new Product($name, $description, $fileDestination, $price);
            $category = new Category($cat_name);
            $new_product = new Crud();
            $new_product->updateProductAndCategory($name, $description, $price, $fileDestination, $cat_name, $_GET['id']);    
        }
    }   
?>

    <form action='updateProduct.php?id=<?= $_GET['id'] ?>' method='post' enctype="multipart/form-data" target='_self'>
    <label for='name'>Name</label><br>
    <input type='text' id='name' name='name' value='<?php echo $productname; ?>' placeholder=''><br>
    <label for="category">Choose a category:</label>
    <select id="category" name="category" >
        <option value="Agrumes" <?php if($category=="Agrumes") {echo "selected";} ?> >Agrumes</option>
        <option value="Fruits à noyau" <?php if($category=="Fruits à noyau") {echo "selected";} ?> >Fruits à noyau</option>
        <option value="Fruits rouges" <?php if($category=="Fruits rouges") {echo "selected";} ?> >Fruits rouges</option>
        <option value="Fruits exotiques" <?php if($category=="Fruits exotiques") {echo "selected";} ?> >Fruits exotiques</option>
    </select>
    <label for='description'>Description</label><br>
    <textarea id='description' name='description' rows='10' cols='30'><?php echo $description; ?></textarea><br><br>
    <label for="image">Upload new picture</label><br>
    <img src="<?php echo $image; ?>" alt="name of the image"> 
    <input type="file" id="image" name="image" placehoder=""><br>
    <label for="price">Price</label><br>
    <input type='number' id='price' name='price' value='<?php echo $price; ?>' placehoder=''><br>
    <input type='submit' name='submit' value='mettre a jour'><br>
    </form>

</body><br><br>
<footer><div class="footer"><b><h3>Fruities © 2020</h3></b><div></footer>
</html>