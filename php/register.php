<?php
include 'db.php';

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
        $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, mail, mdp, niveau) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $mail, $mdp, $niveau]);
        echo "<p class='alert'>Inscription réussie. Vous pouvez maintenant vous connecter.</p>";
        echo '<p><a href="login.php">Connectez-vous ici</a></p>';
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