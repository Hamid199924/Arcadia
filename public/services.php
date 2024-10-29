<?php 
require_once './template/header.php';
require_once './config/database.php'; // Connexion à la base de données avec PDO

// Connexion et récupération des services depuis la base de données
$query = $pdo->prepare('SELECT * FROM services');
$query->execute();
$services = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="background-section">
    <div class="container service-container">
        <div class="row">
            <nav class="col-md-3 service-nav"> 
                <ul>
                    <li><a href="#ticket">Billeterie</a></li>
                    <li><a href="#time">Accès & Horaires</a></li>
                    <li><a href="#train">Petit Train</a></li>
                    <li><a href="#guide">Guide</a></li>
                    <li><a href="#restaurant">Restauration</a></li>
                </ul>
            </nav>
            <div class="col-md-9 content">
                <h1 class="service-title">Services</h1>
                <p class="intro">Découvrez une gamme de services conçus pour enrichir votre expérience et rendre votre visite aussi agréable que possible. 
                    Explorez notre billeterie pour obtenir vos billets d'entrée en toute simplicité, consultez notre plan d'accès et nos horaires pour planifier votre journée parfaite parmi les merveilles de la nature. 
                    Vous pouvez également choisir de profiter de notre petit train pour une visite panoramique confortable du parc, ou opter pour une visite guidée gratuite pour découvrir des faits fascinants sur nos habitants à fourrure et à plumes.
                    Enfin, prenez une pause bien méritée et régalez-vous avec notre service de restauration proposant une variété de délices gastronomiques pour satisfaire toutes les papilles. Au Zoo, nous nous engageons à vous offrir une expérience inoubliable.
                </p>
            </div>
        </div>
    </div>

    <section class="section-services">
    <?php if (empty($services)): ?>
        <p>Aucun service disponible.</p>
    <?php else: ?>
        <?php foreach ($services as $service): ?>
            <div class="service-section" id="<?= htmlspecialchars(strtolower(str_replace(' ', '_', $service['nom']))); ?>">      
                <article class="description">
                    <h2 class="serv-title">
                        <?= isset($service['nom']) ? htmlspecialchars($service['nom']) : 'Nom non disponible'; ?>
                    </h2>
                    <p>
                        <?= isset($service['description']) ? htmlspecialchars($service['description']) : 'Description non disponible'; ?>
                    </p>
                </article>
                <article class="service">
                    <?php
                    // Nom du fichier image basé sur le nom du service
                    $imageName = strtolower(str_replace(' ', '_', $service['nom'])) . '.jpg';
                    ?>
                    <?php if (file_exists("/asset/services/$imageName")): ?>
                        <img src="/assets/services/billet.jpg<?= htmlspecialchars($imageName); ?>" onclick="agrandirImage(this)" />
                    <?php else: ?>
                        <p>Image non disponible</p>
                    <?php endif; ?>
                </article>
                <hr class="service-divider">
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>



  <?php
  require_once './template/footer.php';
  ?>