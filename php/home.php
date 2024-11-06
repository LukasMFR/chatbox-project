<?php
include 'db.php';
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupération des messages depuis la base de données
$stmt = $pdo->query("SELECT * FROM messages ORDER BY timestamp DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chattez'en direct! Chatbox</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="chatbox">
        <!-- Affichage des informations utilisateur et bouton de déconnexion -->
        <div class="user-info">
            <p>
                Connecté en tant que :
                <strong><?= htmlspecialchars($_SESSION['user_prenom']) ?>
                    <?= htmlspecialchars($_SESSION['user_nom']) ?></strong>
                (<?= htmlspecialchars($_SESSION['user_niveau']) ?>)
                <br>
                <span class="user-email"><?= htmlspecialchars($_SESSION['user_mail']) ?></span>
            </p>
            <a href="logout.php" class="logout-button">Se déconnecter</a>
        </div>

        <h1>Chattez'en direct! Chatbox</h1>
        <div class="chat-messages">
            <?php foreach ($messages as $message): ?>
                <?php
                // Utilisation de la fonction pour formater la date
                $formattedDate = formatDateToFrench($message['timestamp']);
                ?>
                <p><?= $formattedDate ?> - <strong><?= htmlspecialchars($message['name']) ?></strong>:
                    <?= htmlspecialchars($message['message']) ?>
                </p>
            <?php endforeach; ?>
        </div>
        <form action="send_message.php" method="post">
            <div class="chat-input">
                <input type="text" name="name" placeholder="Entrez votre nom" class="input-name" required>
                <input type="text" name="message" placeholder="Entrez un message" class="input-message" required>
            </div>
            <div class="send-button">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</body>

</html>