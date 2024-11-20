<?php


// Récupérer les données des animaux depuis la base de données 
$animals = [
    ['animal' => 'Lion', 'views' => 250],
    ['animal' => 'Tigre', 'views' => 150],
    ['animal' => 'Éléphant', 'views' => 300],
    ['animal' => 'Giraf', 'views' => 400],
    // Ajoutez d'autres animaux ici
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Animaux</title>
    <!-- Bootstrap pour la mise en forme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ton fichier CSS personnalisé -->
    <link rel="stylesheet" href="/assets/css/Admin.css">
</head>
<body>

<!-- Header avec le titre et les liens -->
<header class="text-center mb-4">
    <h1>Statistiques des Animaux</h1>
    <div class="d-flex justify-content-between align-items-center">
        <!-- Lien vers le tableau de bord Admin -->
        <a href="admin_dashboard.php" class="btn btn-primary">Retour au Tableau de Bord Admin</a>
        <!-- Lien pour se déconnecter -->
        <a href="./config/logout.php" class="logout btn btn-danger">Déconnexion</a>
    </div>
</header>

<!-- Section pour le tableau des animaux et de leurs "J'aime" -->
<section class="container my-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nom de l'animal</th>
                <th scope="col">Nombre de "J'aime"</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour afficher chaque animal et son nombre de "J'aime" -->
            <?php foreach ($animals as $animal): ?>
                <tr>
                    <!-- Affichage du nom de l'animal -->
                    <td><?php echo htmlspecialchars($animal['animal']); ?></td>

                    <!-- Affichage du nombre de "J'aime" -->
                    <td>
                        <div id="result-<?php echo htmlspecialchars($animal['animal']); ?>">
                            <?php echo htmlspecialchars($animal['views']); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- Fichier JavaScript personnalisé -->
<script src="/assets/js/script.js"></script>

</body>
</html>
