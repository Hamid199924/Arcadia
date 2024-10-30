<?php
session_start();
include('../config/database.php');

// Vérifie si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../template/header.php");
    exit();
}

$user = $_SESSION['user'];

// Filtre animaux
$animalFilter = filter_input(INPUT_GET, 'animal', FILTER_SANITIZE_STRING);
$dateFilter = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);

// Construire la requête SQL avec des filtres conditionnels
$sql = "SELECT * FROM animals WHERE 1=1"; // La clause WHERE 1=1 permet d'ajouter des conditions dynamiquement

$params = [];
if ($animalFilter) {
    $sql .= " AND prenom = :animal";
    $params[':animal'] = $animalFilter;
}
if ($dateFilter) {
    $sql .= " AND date_passage = :date";
    $params[':date'] = $dateFilter;
}

$query = $pdo->prepare($sql);
$query->execute($params);
$animals = $query->fetchAll(PDO::FETCH_ASSOC);

// Fonction pour sécuriser l'affichage
function escape($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/Admin.css">
</head>
<body>
<header class="bg-light py-3 text-center">
    <h1>Bienvenue, <?php echo escape($user['username']); ?>!</h1>
    <p>Vous êtes connecté en tant qu'<strong>Administrateur</strong>.</p>
    <a href="../config/logout.php" class="logout btn btn-danger">Déconnexion</a>
</header>

<div class="container my-4">
    <section class="user-section mb-5">
        <h2 class="text-center">Gestion des Comptes Utilisateurs</h2>
        <div class="col-lg-6 mx-auto">
            <h3 class="text-center">Créer un nouvel utilisateur</h3>
            <form action="./../actions/users/create_user.php" method="POST" class="p-3 bg-light rounded shadow">
                <div class="mb-3">
                    <label for="username" class="form-label">Email (Nom d'utilisateur)</label>
                    <input type="email" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="employee">Employé</option>
                        <option value="veterinarian">Vétérinaire</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Créer l'utilisateur</button>
            </form>
        </div>

        <div class="row mt-5">
            <?php while ($userRow = $stmtUsers->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="user-item p-3 rounded shadow">
                        <p><strong>Nom d'utilisateur:</strong> <?php echo escape($userRow['username']); ?></p>
                        <p><strong>Rôle:</strong> <?php echo escape($userRow['role']); ?></p>
                        <?php if ($userRow['role'] !== 'admin'): ?>
                            <form action="../actions/users/delete_user.php" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="<?php echo escape($userRow['id']); ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

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
                    <?php while ($service = $stmtServices->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td>
                                <form action="../actions/services/update_services.php" method="post" class="d-inline">
                                    <input type="text" name="nom" value="<?php echo escape($service['nom']); ?>" required>
                            </td>
                            <td>
                                <input type="text" name="description" value="<?php echo escape($service['description']); ?>" required>
                            </td>
                            <td>
                                <input type="hidden" name="service_id" value="<?php echo escape($service['id']); ?>">
                                <input type="hidden" name="action" value="update">
                                <button type="submit" class="btn btn-warning">Modifier</button>
                                </form>
                                <form action="../actions/services/update_services.php" method="post" class="d-inline">
                                    <input type="hidden" name="service_id" value="<?php echo escape($service['id']); ?>">
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

<div class="container mt-4">
    <h2 class="text-center mb-4">Comptes Rendus Vétérinaires</h2>

    <form method="GET" action="" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="animal" class="form-label">Filtrer par animal</label>
                <select id="animal" name="animal" class="form-select">
                    <option value="">Tous les animaux</option>
                    <?php
                    $animalListQuery = $pdo->query("SELECT DISTINCT prenom FROM animals");
                    while ($animalRow = $animalListQuery->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($animalRow['prenom'] === $animalFilter) ? 'selected' : '';
                        echo "<option value=\"" . escape($animalRow['prenom']) . "\" $selected>" . escape($animalRow['prenom']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">Filtrer par date</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo escape($dateFilter); ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Appliquer les filtres</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Prénom</th>
                    <th>Race</th>
                    <th>État</th>
                    <th>Nourriture proposée</th>
                    <th>Grammage</th>
                    <th>Date de Passage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($animals): ?>
                    <?php foreach ($animals as $animal): ?>
                        <tr>
                            <td><?php echo escape($animal['prenom']); ?></td>
                            <td><?php echo escape($animal['race']); ?></td>
                            <td>
                                <form action="../actions/animal/update_animal.php" method="post">
                                    <input type="hidden" name="animal_id" value="<?php echo escape($animal['id']); ?>">
                                    <input type="text" name="etat_animal" value="<?php echo escape($animal['etat_animal']); ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="text" name="nourriture_proposee" value="<?php echo escape($animal['nourriture_proposee']); ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="number" name="grammage_nourriture" value="<?php echo escape($animal['grammage_nourriture']); ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="datetime-local" name="date_passage" value="<?php echo escape(date('Y-m-d\TH:i', strtotime($animal['date_passage']))); ?>" class="form-control" required>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success">Modifier</button>
                                </form>
                                <form action="../actions/animal/delete_animal.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cet animal ?');">
                                    <input type="hidden" name="animal_id" value="<?php echo escape($animal['id']); ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun compte rendu trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container text-center my-5">
    <h2 class="text-center mb-4">Statistiques Admin</h2>
    <a href="/public/Admin_stats.php" class="futuristic-link">Voir les Statistiques</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



