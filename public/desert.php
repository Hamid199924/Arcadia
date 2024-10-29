<?php 
require_once '../config/database.php'; // Connexion à la base de données
require_once '../template/header.php';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=arcadia;charset=utf8', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur de connexion : " . $e->getMessage();


  $query->execute();
$animals = $query->fetchAll(PDO::FETCH_ASSOC);

// Organiser les données par prénom
$animalsByName = array_column($animals, null, 'prenom');

// Vérifier si des données ont été trouvées
if ($animalsByName) {
  foreach ($animalsByName as $prenom => $animal) {
      // Traitement des données de chaque animal ici
  }
} else {
  echo "Aucun animal trouvé.";
}
}
?>

<link rel="stylesheet" href="../assets/css/index.css">
<div class="background-section-desert">
  <div class="container service-container">
    <div class="row">
    <nav class="col-md-3 service-nav"> 
    <ul>
        <?php 
            // Tableau associatif des pages et leurs noms affichés
            $pages = [
                'desert.php' => 'Désert',
                'jungle.php' => 'Jungle',
                'mountain.php' => 'Montagne',
                'marais.php' => 'Marais',
                'savane.php' => 'Savane'
            ];
            
            // Page actuelle
            $currentPage = basename($_SERVER['PHP_SELF']);
            
            // Boucle pour générer les éléments de navigation
            foreach ($pages as $file => $title) {
                $isActive = ($currentPage === $file) ? 'class="active"' : '';
                echo "<li $isActive><a href=\"$file\">$title</a></li>";
            }
        ?>
    </ul>
</nav>

      <div class="col-md-9 content animals-intro">
        <h1 class="animals-title">Désert</h1>
        <p class="intro-animals">
          Bienvenue dans notre zoo, une oasis de découverte au cœur de la nature sauvage. Explorez notre désert reconstitué, un monde de vastes enclos rocailleux et de ciels infinis. Ici, la vie prospère malgré les défis, avec des créatures extraordinaires adaptées à ce milieu unique. Rencontrez le majestueux cobra royal, le charmant fennec, la redoutable vipère du désert, le gracieux dromadaire et l'insaisissable iguane du désert, chacun illustrant une résilience remarquable dans ce paysage désolé mais magnifique.
        </p>
      </div>
    </div>
  </div>

<section class="section-services">
  <!-- Animal 1: Nick - Vipère des sables -->
  <div class="service1">
    <article class="description">
      <p>
        Prénom : Nick <br>
        Race : Vipère des sables <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Zones désertiques d'Afrique du Nord et du Moyen-Orient <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Nick']['etat_animal']); ?> <br>
       Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Nick']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Nick']['grammage_nourriture']); ?> <br>
       Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Nick']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Nick" class="jaime-btn" data-animal="Nick">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src=".././assets/desert/viperedesert.jpg" onclick="agrandirImage(this)" width="200", height="200"/>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 2: Feunard - Fennec -->
  <div class="service2">
    <article class="service">
      <img src=".././assets/desert/fenec.jpg" onclick="agrandirImage(this)" width="200", height="200" />
    </article>
    <article class="description">
      <p>
        Prénom : Feunard <br>
        Race : Fennec <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Déserts d'Afrique du Nord <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Feunard']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Feunard']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Feunard']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Feunard']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Feunard" class="jaime-btn" data-animal="Feunard">❤️ J'aime</button>
      </div>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 3: Abo - Cobra royal -->
  <div class="service3">
    <article class="description">
      <p>
        Prénom : Abo <br>
        Race : Cobra royal <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Forêts tropicales, plaines et déserts d'Asie <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Abo']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Abo']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Abo']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Abo']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Abo" class="jaime-btn" data-animal="Abo">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src=".././assets/desert/cobraroyal.jpg" onclick="agrandirImage(this)"  width="200", height="200"/>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 4: Doma - Dromadaire -->
  <div class="service4">
    <article class="service">
      <img src=".././assets/desert/dromadaire.jpg" onclick="agrandirImage(this)" />
    </article>
    <article class="description">
      <p>
        Prénom : Doma <br>
        Race : Dromadaire <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Déserts d'Afrique du Nord et du Moyen-Orient <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Doma']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Doma']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Doma']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Doma']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Doma" class="jaime-btn" data-animal="Doma">❤️ J'aime</button>
      </div>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 5: Zed - Iguane du désert -->
  <div class="service5">
    <article class="description">
      <p>
        Prénom : Zed <br>
        Race : Iguane du désert <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Déserts d'Amérique du Nord <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Zed']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Zed']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Zed']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Zed']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Zed" class="jaime-btn" data-animal="Zed">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src=".././assets/desert/iguanedesert.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</body>
</html>

<?php require_once '.././template/footer.php'; ?>
