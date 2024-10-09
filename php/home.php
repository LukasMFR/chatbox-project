<?php
include 'db.php';

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