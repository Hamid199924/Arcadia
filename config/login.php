<?php
session_start();
include "../../config/database.php";
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les valeurs des champs du formulaire
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $role = htmlspecialchars(trim($_POST["role"]));
    // Connexion à la base de données (à adapter selon ta configuration)

    $pdo = new PDO("mysql:host=localhost;dbname=arcade", "root", "");
    // Préparer une requête sécurisée

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND role = :role");
    $stmt->execute(["username" => $username, "role" => $role]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user["password"])) {

        // Connexion réussie : Rediriger l'utilisateur vers la page d'accueil
        if ($role === "admin") {
            header("Location: ../../../public/admin.php");
        } elseif ($role === "employee") {
            header("Location: ../../../public/employee.php");

        } else {
            header("Location: ../../../public/veterinaire.php");

        }

    } else {
        // Erreur : Identifiants incorrects
        echo "Nom d'utilisateur, mot de passe ou rôle incorrect.";

    }

}
?>