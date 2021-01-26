<?php
    include_once("dbh.php");


    class User extends Dbh {

        public function setUser($name, $pass, $mail, $admin, $createdat) {
            try {
            //    $createdat = NOW();
                $conn = $this->connect();
                $sql = "INSERT INTO users (username, password, email, admin, created_at) VALUES ('$name', '$pass', '$mail', '$admin', '$createdat')";
                $conn->exec($sql);

                echo "Inscription réussie !";
              } catch(Exception $e) {
                echo $e->getMessage();
              }
        }
    }
