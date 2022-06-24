<?php
$dsn = "mysql:host=localhost;dbname=sobox;charset=utf8";
$user = "root";
$pass = "";

try {
    $cnx = new PDO($dsn, $user, $pass);
} catch (exception $e) {
    die('Erreur de connexion à la base de donnée !' . $e->getMessage());
}
?>