<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (:name, :message)");
        $stmt->execute(['name' => $name, 'message' => $message]);
    }
}

header('Location: home.php');
exit();
