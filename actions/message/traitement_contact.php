<?php
include '../../config/database.php';

// Récupérer les données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupérer les données du formulaire
        $email = trim($_POST['email']); // Suppression des espaces inutiles
        $motif = isset($_POST['motif']) ? trim($_POST['motif']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null; 
        // Valider les données (ajout de sécurité)
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email est invalide ou manquant.");
        }

        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=Arcadia", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête
        $sql = "INSERT INTO contact (email, motif, description, date_contact) 
                VALUES (:email, :motif, :description, NOW())";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête
        $stmt->execute([
            ':email' => $email,
            ':motif' => $motif,
            ':description' => $description,
        ]);

        // Redirection avec confirmation
        header("Location: confirmation.php?message=success");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    } catch (Exception $e) {
        // Gestion des erreurs générales
        die("Erreur : " . $e->getMessage());
    }
}
?>

