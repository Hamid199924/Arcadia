<?php
session_start();
require_once '../config/database.php'; // Connexion à la base de données

// Vérifiez si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['employee']) || $_SESSION['employee']['role'] !== 'employee') {
     header("location: ../../../template/header.php");
     exit();
}

// Assurez-vous que la clé 'employee' est définie dans la session
if (isset($_SESSION['employee'])) {
    $_SESSION['employee'] = $_SESSION['employee'];
}

//$employee = $_SESSION['employee']; // Récupère les informations de l'employé connecté

try {
    $pdo = new PDO('mysql:host=localhost;dbname=Arcadia', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    die("erreur de connexion : " . $e->getMessage);
    
    // Récupère les messages non lus depuis la table `contact`
    $sqlMessages = "SELECT id, email, message, date_contact FROM contact ORDER BY date_contact DESC";
    $stmtMessages = $pdo->query($sqlMessages);

    // Récupère les avis non validés depuis la table `avis`
    $sqlAvis = "SELECT id, commentaire, date_avis FROM avis ORDER BY date_avis DESC";
    $stmtAvis = $pdo->query($sqlAvis);

    // Récupère les informations de tous les animaux pour l'affichage et modification
    $sqlAnimals = "SELECT * FROM animal";
    $stmtAnimals = $pdo->query($sqlAnimals);

    // Récupère les services depuis la base de données
    $sqlServices = "SELECT id, nom, description FROM services";
    $stmtServices = $pdo->query($sqlServices);

} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Employé</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/index.css">
</head>
<body>
    <header class="bg-light py-3 text-center">
        <h1>Bienvenue</h1>
        <p>Vous êtes connecté en tant qu'<strong>Employé</strong>.</p>
        <a href="./config/logout.php" class="logout btn btn-danger">Déconnexion</a>
    </header>
    <div class="container my-4">
    <!-- Section pour gérer les messages des visiteurs -->
    <section class="message-section mb-5">
        <h2 class="text-center">Messages des Visiteurs</h2>
        <div class="row">
            <?php while ($rowMessage = $stmtMessages->fetch()): ?>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="message-item p-3 rounded shadow">
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($rowMessage['email'] ?? "Non disponible"); ?></p>
                        <p><strong>Motif:</strong> <?php echo htmlspecialchars($rowMessage['motif'] ?? "Non disponible"); ?></p>
                        <p><strong>Message:</strong> <?php echo htmlspecialchars($rowMessage['description'] ?? "Non disponible"); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($rowMessage['date_creation'] ?? "Non disponible"); ?></p>
                        <p><strong>Status:</strong> <?php echo htmlspecialchars($rowMessage['status'] ?? "Non disponible"); ?></p>
                        <form action="./actions/message/marquer_lu.php" method="POST" class="d-inline">
                            <input type="hidden" name="contact_id" value="<?php echo htmlspecialchars($rowMessage['id'] ?? ""); ?>">
                            <button type="submit" class="btn btn-success">Marquer comme lu</button>
                        </form>
                        <form action="./actions/message/supprimer_contact.php" method="POST" class="d-inline">
                            <input type="hidden" name="contact_id" value="<?php echo htmlspecialchars($rowMessage['id'] ?? ""); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Section pour valider les avis -->
    <section class="avis-section mb-5">
        <h2 class="text-center">Validation des Avis</h2>
        <div class="row">
            <?php while ($rowAvis = $stmtAvis->fetch()): ?>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="avis-item p-3 rounded shadow">
                        <p><strong>Avis de:</strong> <?php echo htmlspecialchars($rowAvis['pseudo'] ?? "Non disponible"); ?></p>
                        <p><strong>Commentaire:</strong> <?php echo htmlspecialchars($rowAvis['commentaire'] ?? "Non disponible"); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($rowAvis['date_creation'] ?? "Non disponible"); ?></p>
                        <form action="./actions/avis/traitement_employee.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($rowAvis['id'] ?? ""); ?>">
                            <input type="hidden" name="action" value="valider">
                            <button type="submit" class="btn btn-success">Valider</button>
                        </form>
                        <form action="./actions/avis/traitement_employee.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($rowAvis['id'] ?? ""); ?>">
                            <input type="hidden" name="action" value="supprimer">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Section pour gérer l'alimentation des animaux -->
    <section class="animal-section">
        <h2 class="text-center">Gestion des Animaux</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Prénom</th>
                    <th>Race</th>
                    <th>État</th>
                    <th>Nourriture Proposée</th>
                    <th>Grammage</th>
                    <th>Date de Passage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($animal = $stmtAnimals->fetch()): ?>
                    <tr>
                        <form action="./actions/animals/update_animal.php" method="post">
                            <td><?php echo htmlspecialchars($animal['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($animal['race']); ?></td>
                            <td>
                                <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($animal['id']); ?>">
                                <input type="text" name="etat_animal" value="<?php echo htmlspecialchars($animal['etat_animal']); ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="text" name="nourriture_proposee" value="<?php echo htmlspecialchars($animal['nourriture_proposee']); ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="number" name="grammage_nourriture" value="<?php echo htmlspecialchars($animal['grammage_nourriture']); ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="datetime-local" name="date_passage" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($animal['date_passage']))); ?>" class="form-control" required>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <!-- Section pour gérer les services -->
    <section class="service-section mt-5">
        <h2 class="text-center mb-4">Gestion des Services</h2>
        <div class="container">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nom du Service</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($service = $stmtServices->fetch()): ?>
                        <tr>
                            <form action="./actions/services/update_services.php" method="post">
                                <td>
                                    <input type="text" name="nom" value="<?php echo htmlspecialchars($service['nom']); ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="description" value="<?php echo htmlspecialchars($service['description']); ?>" required>
                                </td>
                                <td>
                                    <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['id']); ?>">
                                    <input type="hidden" name="action" value="update">
                                    <button type="submit" class="btn btn-warning">Modifier</button>
                                </td>
                            </form>
                            <td>
                                <form action="./actions/services/update_services.php" method="post" class="d-inline">
                                    <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['id']); ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Script Bootstrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
