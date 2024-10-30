<?php
$host = 'localhost'; // Le serveur MySQL (ou l'adresse IP)
$dbname = 'Arcadia'; // Nom de la base de données
$username = 'root';  // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL

try {
    // Création de la connexion avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configuration pour lancer des exceptions en cas d'erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie à la base de données!";
} catch (PDOException $e) {
    // Gérer les erreurs de connexion
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
