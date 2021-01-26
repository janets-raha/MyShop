<?php

    if(!isset($_SESSION['Pseudo'])) {
        header("location:index.php");
    } 

include_once("db_crud.php");

if(isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $delete = new Crud();
    $delete->deleteProduct($id);
    header('Location: showAllProducts.php');
    exit();
}

?>
