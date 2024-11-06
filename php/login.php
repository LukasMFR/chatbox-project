<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $mdp = sha1($_POST['mdp']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE mail = ? AND mdp = ?");
    $stmt->execute([$mail, $mdp]);
    $user = $stmt->fetch();

    if ($user) {
        // Enregistrement de toutes les informations dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_mail'] = $user['mail'];
        $_SESSION['user_niveau'] = $user['niveau'];

        header("Location: home.php");
        exit;
    } else {
        echo "<p>E-mail ou mot de passe incorrect.</p>";
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
    <h2>Connexion</h2>
    <form method="POST" action="">
        <input type="email" name="mail" placeholder="E-mail" required><br>
        <input type="password" name="mdp" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
</body>

</html>