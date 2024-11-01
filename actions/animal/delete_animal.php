<?php
session_start();
include '../../config/connexion_bd.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupére l'ID de l'animal à supprimer
    $animalId = $_POST['animal_id'];

    // Prépare et exécute la requête de suppression
    $query = $pdo->prepare("DELETE FROM animals WHERE id = :id");
    $query->execute([
        'id' => $animalId
    ]);

    // Vérifie le rôle de l'utilisateur pour la redirection
    if ($_SESSION['user']['role'] === 'admin') {
        // Redirige vers l'administrateur
        header("Location: ../../../../public/dashborad.php");
    } elseif ($_SESSION['user']['role'] === 'employee') {
        // Redirige vers employe
        header("Location: ../../../../public/employee.php");
    }

    exit();
}
?>
