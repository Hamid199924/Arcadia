<?php
session_start();
include("/config/database.php"); // Connexion à la base de données avec PDO

function getMessages($pdo) {
    $stmt = $pdo->query("SELECT * FROM contact");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAvis($pdo) {
    $stmt = $pdo->query("SELECT * FROM avis");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAnimals($pdo) {
    $stmt = $pdo->query("SELECT * FROM animal");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServices($pdo) {
    $stmt = $pdo->query("SELECT * FROM service");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("location: ../../../template/header.php");
    exit();
}
$user = $_SESSION['user'];
?>
