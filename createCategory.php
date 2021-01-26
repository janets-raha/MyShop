<!DOCTYPE html>
<html>
<body>

<?php 

    include_once("db_crud.php");
    include_once("product.php");
    include_once("category.php");

    if(isset($_POST["submit"])) {
        
        $cat_name = $_POST["category"];

        if((strlen($cat_name)<3 || strlen($cat_name)>15)) {
            echo "Le nom doit contenir entre 3 à 15 characteres" . "\n";
        } else {
    ///     header('Location: index.php?uploadsuccess'); insert in final version                        
            $category = new Category($cat_name);
            $new_category = new Crud();
            $new_category->setCategory($category);
        }
    }  
?>
    <form action='createCategory.php' method='post' enctype="multipart/form-data" target='_self'>
    <label for='category'>Nom de la nouvelle categorie</label><br>
    <input type='text' id='category' name='category' placehoder='my_category'><br>
    <input type='submit' name='submit' value='Valider'>
    </form>

</body>
</html>
