<?php
include __DIR__. 'admin/emplo.php';

$messages = getMessages($pdo);
$avis = getAvis($pdo);
$animals = getAnimals($pdo);
$services = getServices($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/Admin.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <header class="bg-light py-3 text-center">
        <h1>Bienvenue, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <p>Vous êtes connecté en tant qu'<strong>Employé</strong>.</p>
        <a href="../config/logout.php" class="logout btn btn-danger">Déconnexion</a>
    </header>

    <div class="container my-4">
        <!-- Section Messages des Visiteurs -->
        <section class="message-section mb-5">
            <h2 class="text-center">Messages des Visiteurs</h2>
            <div class="row">
                <?php foreach ($messages as $message): ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="message-item p-3 rounded shadow">
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?></p>
                            <p><strong>Motif:</strong> <?php echo htmlspecialchars($message['motif']); ?></p>
                            <p><strong>Message:</strong> <?php echo htmlspecialchars($message['description']); ?></p>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($message['date_creation']); ?></p>
                            <p><strong>Status:</strong> <?php echo htmlspecialchars($message['status']); ?></p>
                            <form action="../actions/message/marquer_lu.php" method="POST" class="d-inline">
                                <input type="hidden" name="contact_id" value="<?php echo $message['id']; ?>">
                                <button type="submit" class="btn btn-success">Marquer comme lu</button>
                            </form>
                            <form action="../actions/message/supprimer_contact.php" method="POST" class="d-inline">
                                <input type="hidden" name="contact_id" value="<?php echo $message['id']; ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Section Validation des Avis -->
        <section class="avis-section mb-5">
            <h2 class="text-center">Validation des Avis</h2>
            <div class="row">
                <?php foreach ($avis as $avisItem): ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="avis-item p-3 rounded shadow">
                            <p><strong>Avis de:</strong> <?php echo htmlspecialchars($avisItem['pseudo']); ?></p>
                            <p><strong>Commentaire:</strong> <?php echo htmlspecialchars($avisItem['commentaire']); ?></p>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($avisItem['date_creation']); ?></p>
                            <form action="../actions/avis/traitement_employee.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $avisItem['id']; ?>">
                                <input type="hidden" name="action" value="valider">
                                <button type="submit" class="btn btn-success">Valider</button>
                            </form>
                            <form action="../actions/avis/traitement_employee.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $avisItem['id']; ?>">
                                <input type="hidden" name="action" value="supprimer">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Section Gestion des Animaux -->
        <section class="animal-section mb-5">
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
                    <?php foreach ($animals as $animal): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($animal['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($animal['race']); ?></td>
                            <td>
                                <form action="../actions/animal/update_animal.php" method="post">
                                    <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                                    <input type="text" name="etat_animal" value="<?php echo htmlspecialchars($animal['etat_animal']); ?>" class="form-control">
                            </td>
                            <td><input type="text" name="nourriture_proposee" value="<?php echo htmlspecialchars($animal['nourriture_proposee']); ?>" class="form-control"></td>
                            <td><input type="number" name="grammage_nourriture" value="<?php echo htmlspecialchars($animal['grammage_nourriture']); ?>" class="form-control"></td>
                            <td><input type="datetime-local" name="date_passage" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($animal['date_passage']))); ?>" class="form-control" required></td>
                            <td><button type="submit" class="btn btn-primary">Mettre à jour</button></form></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Section Gestion des Services -->
        <section class="service-section mt-5">
            <h2 class="text-center mb-4">Gestion des Services</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nom du Service</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><form action="../actions/services/update_services.php" method="post" class="d-inline">
                                <input type="text" name="nom" value="<?php echo htmlspecialchars($service['nom']); ?>" required></td>
                            <td><input type="text" name="description" value="<?php echo htmlspecialchars($service['description']); ?>" required></td>
                            <td><input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                <input type="hidden" name="action" value="update"><button type="submit" class="btn btn-warning">Modifier</button></form>
                                <form action="../actions/services/update_services.php" method="post" class="d-inline">
                                    <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                    <input type="hidden" name="action" value="supprimer"><button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
