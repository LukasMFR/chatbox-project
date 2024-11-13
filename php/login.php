<?php
include 'db.php';
session_start();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $mdp = sha1($_POST['mdp']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE mail = ? AND mdp = ?");
    $stmt->execute([$mail, $mdp]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_mail'] = $user['mail'];
        $_SESSION['user_niveau'] = $user['niveau'];
        header("Location: home.php");
        exit;
    } else {
        $error_message = "E-mail ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="form-container">
        <h2>Connexion</h2>
        <?php if ($error_message): ?>
            <p class="alert"><?= $error_message ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="email" name="mail" placeholder="E-mail" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
    </div>
</body>

</html>