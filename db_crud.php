<?php
    include_once("dbh.php");


    class Crud extends Dbh {

        public function setProduct($product, $category) {
            try {                 
                $name = $product->get_name();
                $description = $product->get_description();
                $image = $product->get_image();
                $price = $product->get_price();
                $cat_name = $category->get_name();
                $conn = $this->connect();
                $sqlv = "INSERT INTO categories (name) VALUES ('$cat_name')";
                $conn->exec($sqlv);
                $last_id = $conn->lastInsertId();
                $sqlw = "INSERT INTO products (name, description, price, image, category_id)
                VALUES ('$name', '$description', '$price','$image', '$last_id')";
                $conn->exec($sqlw);
                echo "Le nouveau fruit a été rajouté avec succès.";
              } catch(PDOException $e) {
                echo $e->getMessage();
              }
        }

        public function getProduct() {
            $conn = $this->connect();
            $sql = $conn->prepare("SELECT * FROM products");
            $sql->execute();
            return $sql;
        }

        public function getCategory() {
            $conn = $this->connect();
            $sql = $conn->prepare("SELECT * FROM categories");
            $sql->execute();
            return $sql;
        }

        public function getProductsAndCategorynames() {
            $conn = $this->connect();
            $sql = $conn->prepare("SELECT products.*, categories.name AS categoryname FROM products, categories WHERE products.category_id = categories.id");
            $sql->execute();
            return $sql;
        }

        public function setCategory($category) {
            $cat_name = $category->get_name();
            $conn = $this->connect();
            $sql = "INSERT INTO categories (name) VALUES ('$cat_name')";
            $conn->exec($sql);
        }

        public function getProductAndCategory($id) {
            $conn = $this->connect();
            $sql = $conn->prepare("SELECT products.id, products.name as productname, products.description, products.price, products.image, categories.name as categoryname FROM products, categories WHERE products.category_id = categories.id AND products.id = '$id'");
            $sql->execute();
            return $sql;
        }

        public function updateProductAndCategory($name, $description, $price, $fileDestination, $cat_name, $id) {
            $conn = $this->connect();
            $sql = $conn->prepare("UPDATE products, categories SET products.name='$name', products.description='$description', products.price='$price', categories.name = '$cat_name' WHERE products.category_id = categories.id AND products.id='$id'");
            $sql->execute();
            return $sql;
        }

        public function deleteProduct($id) {
            $conn = $this->connect();
            $sql = $conn->prepare("DELETE products.*, categories.* FROM products, categories WHERE products.category_id = categories.id AND products.id = '$id'");
            $sql->execute();
            return $sql; 
        }

    }
    //// $pdo = null;
?>