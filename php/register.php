<?php
include 'db.php';
session_start();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $mdp = sha1($_POST['mdp']);
    $niveau = 'utilisateur';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE mail = ?");
    $stmt->execute([$mail]);

    if ($stmt->rowCount() > 0) {
        $error_message = "Un compte avec cet e-mail existe déjà.";
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, mail, mdp, niveau) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $mail, $mdp, $niveau]);

        // Récupérer l'ID du nouvel utilisateur
        $user_id = $pdo->lastInsertId();

        // Créer la session pour l'utilisateur nouvellement inscrit
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_nom'] = $nom;
        $_SESSION['user_prenom'] = $prenom;
        $_SESSION['user_mail'] = $mail;
        $_SESSION['user_niveau'] = $niveau;

        // Définir un message de succès
        $_SESSION['success_message'] = "Inscription réussie ! Bienvenue, " . htmlspecialchars($prenom) . ".";

        header("Location: home.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="form-container">
        <h2>Inscription</h2>
        <?php if ($error_message): ?>
            <p class="alert"><?= $error_message ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="mail" placeholder="E-mail" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
    </div>
</body>

</html>