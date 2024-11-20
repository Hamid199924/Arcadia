<?php 
include '../config/database.php'; // Connexion à la base de données
// Initialisez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'veterinaire') {
    header("location: ../../../template/header.php");
    exit();
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=Arcadia', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    die('Erreur de connexion : ' . $e->getMessage());
    
    // Récupère les informations de tous les animaux
    $query = $pdo->prepare("SELECT * FROM animal");
    $query->execute();
    $animals = $query->fetchAll(PDO::FETCH_ASSOC);

    // Vérifiez si des animaux ont été récupérés
    if (empty($animals)) {
        echo "Aucun animal trouvé dans la base de données.";
    }
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
    <title>Tableau de Bord Vétérinaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/Admin.css">
</head>
<body>
    <header class="text-center bg-light py-3">
        <h1>Bienvenue, <?php echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : 'Utilisateur'; ?>!</h1>
        <p>Vous êtes connecté en tant que <strong>Vétérinaire</strong>.</p>
        <a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>
    </header>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Mise à jour des informations des Animaux</h2>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($animals)) { ?>
                        <?php foreach ($animals as $animal) { ?>
                            <tr>
                                <td><?php echo isset($animal['prenom']) ? htmlspecialchars($animal['prenom']) : 'N/A'; ?></td>
                                <td><?php echo isset($animal['race']) ? htmlspecialchars($animal['race']) : 'N/A'; ?></td>
                                <td>
                                    <form action="./actions/animals/update_animal.php" method="post">
                                        <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                                        <input type="text" name="etat_animal" value="<?php echo isset($animal['etat_animal']) ? htmlspecialchars($animal['etat_animal']) : ''; ?>" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="nourriture_proposee" value="<?php echo isset($animal['nourriture_proposee']) ? htmlspecialchars($animal['nourriture_proposee']) : ''; ?>" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="grammage_nourriture" value="<?php echo isset($animal['grammage_nourriture']) ? htmlspecialchars($animal['grammage_nourriture']) : ''; ?>" class="form-control" required>
                                </td>
                                <td>
                                    <input type="datetime-local" name="date_passage" 
                                        value="<?php echo isset($animal['date_passage']) ? htmlspecialchars(date('Y-m-d\TH:i', strtotime($animal['date_passage']))) : ''; ?>" 
                                        class="form-control" required>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Aucun animal trouvé.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
