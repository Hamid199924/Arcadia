<?php
session_start();
include '../../config/conneion_bdd.php';

if (isset($_POST['contact_id'])) {
    $contact_id = $_POST['contact_id'];
    $sql = "DELETE FROM contact WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contact_id]);
}

header("Location: ../../../../public/employee.php");
exit();
?>