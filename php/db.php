<?php
$host = 'localhost';  // ou l'adresse de ton serveur SQL
$db = 'chatbox';
$user = 'root';       // utilisateur MySQL (à personnaliser si nécessaire)
$pass = '';           // mot de passe MySQL (à personnaliser)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>