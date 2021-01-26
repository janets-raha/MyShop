<?php
function connexionToDatabase()
{
    $host = "localhost";
    $port = 3306;
    $dbname = "my_shop";
    $username = "newuser";
    $password = turquetil;
    try
    {
        $server = "mysql:host=" . $host . ";dbname=" .$dbname . ";port=" . $port;
        $connexion = new PDO($server, $username, $password);
    //    echo "teamGroup8, tu es bien connecté à la base de données my_shop.\n";
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connexion;
    }
    catch (Exception $error)
    {
        die("Erreur lors de la connection à ma base de données my_shop. " . $error->getMessage());
    }
}
