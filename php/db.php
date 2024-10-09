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

// Fonction pour formater la date et traduire les mois en français
function formatDateToFrench($date)
{
    $months = [
        'January' => 'janvier',
        'February' => 'février',
        'March' => 'mars',
        'April' => 'avril',
        'May' => 'mai',
        'June' => 'juin',
        'July' => 'juillet',
        'August' => 'août',
        'September' => 'septembre',
        'October' => 'octobre',
        'November' => 'novembre',
        'December' => 'décembre'
    ];

    // Créer un objet DateTime
    $dateTime = new DateTime($date);

    // Formater la date en anglais
    $formattedDate = $dateTime->format('j F Y à H:i:s');

    // Remplacer le mois anglais par le mois français
    foreach ($months as $english => $french) {
        $formattedDate = str_replace($english, $french, $formattedDate);
    }

    return 'Le ' . $formattedDate;
}
?>