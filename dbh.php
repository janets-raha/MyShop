<?php

    class Dbh {

        private $servername;
        private $username;
        private $password;
        private $dbname;

        public function __construct() {
            $this->servername = "localhost";
            $this->username = "newuser";
            $this->password = "turquetil";
            $this->dbname = "my_shop";
        }

        public function connect() {
            try {
                $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname;
                $pdo = new PDO($dsn,$this->username,$this->password);
                // set the PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully";
                return $pdo;
            } catch(PDOException $e) {
                echo "Erreur de connexion: " . $e->getMessage();
            }
        }

    }

?>
