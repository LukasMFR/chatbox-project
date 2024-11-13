<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère le prénom et le nom de l'utilisateur connecté
    $name = $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (:name, :message)");
        $stmt->execute(['name' => $name, 'message' => $message]);
    }
}

header('Location: home.php');
exit();