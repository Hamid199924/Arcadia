<?php
require_once '../template/header.php';
require_once '../config/database.php';

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=Arcadia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //die("Erreur de connexion : " . $e->getMessage());
} catch (PDOException $e) {
    //echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Récupère les services
$query = $pdo->prepare("SELECT * FROM services WHERE id BETWEEN 1 AND 6");
$query->execute();
$services = $query->fetchAll(PDO::FETCH_ASSOC);

// Organise les services par ID
$servicesById = [];
foreach ($services as $service) {
    $servicesById[$service['id']] = $service;
}
?>

 <link rel="stylesheet" href=".././assets/css/index.css" />

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
        <p class="intro">Découvrez une gamme de services conçus pour enrichir votre expérience et rendre votre visite aussi agréable que possible.</p>
      </div>
    </div>
  </div>

  <section class="section-services">
    <div class="service1" id="ticket">      
      <article class="description">
        <h2 class="serv-title"><?php echo htmlspecialchars($servicesById[1]['nom'] ?? ''); ?></h2>
        <p><?php echo htmlspecialchars($servicesById[1]['description'] ?? ''); ?></p>
      </article>
      <article class="service">
        <img src="../assets/services/billet.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <div class="service2" id="time">
      <article class="service">
        <img src="../assets/services/zoo.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
        <h2 class="serv-title"><?php echo htmlspecialchars($servicesById[2]['nom'] ?? ''); ?></h2>
        <p><?php echo htmlspecialchars($servicesById[2]['description'] ?? ''); ?></p>
        <h2 class="serv-title"><?php echo htmlspecialchars($servicesById[3]['nom'] ?? ''); ?></h2>
        <p><?php echo htmlspecialchars($servicesById[3]['description'] ?? ''); ?></p>
      </article>
    </div>
    <hr class="service-divider">

    <div class="service3" id="train">
      <article class="description">
        <h2 class="serv-title"><?php echo htmlspecialchars($servicesById[4]['nom'] ?? ''); ?></h2>
        <p><?php echo htmlspecialchars($servicesById[4]['description'] ?? ''); ?></p>
      </article>
      <article class="service">
        <img src="../assets/services/minitrain.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <div class="service4" id="guide">
      <article class="service">
        <img src="../assets/services/guide.jpg" onclick="agrandirImage(this)" />
        
      </article>
      <article class="description">
        <h2 class="serv-title"><?php echo htmlspecialchars($servicesById[5]['nom'] ?? ''); ?></h2>
        <p><?php echo htmlspecialchars($servicesById[5]['description'] ?? ''); ?></p>
      </article>
    </div>
    <hr class="service-divider">

    <div class="service5" id="restaurant">
      <article class="description">
        <h2 class="serv-title"><?php echo htmlspecialchars($servicesById[6]['nom'] ?? ''); ?></h2>
        <p><?php echo htmlspecialchars($servicesById[6]['description'] ?? ''); ?></p>
      </article>
      <article class="service">
        <img src="../assets/services/restaurant.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
  </section>
</div>

<?php include '../template/footer.php'?>