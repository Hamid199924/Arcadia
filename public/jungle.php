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
<div class="background-section-jungle">
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
          <h1 class="animals-title">Jungle</h1>
          <p class="intro-animals">
            Bienvenue dans la Jungle, un monde d'exploration et de diversité au cœur même de notre zoo. Découvrez l'anaconda, 
            le jaguar, le macaque, le perroquet et le tigre, chacun adapté à ce royaume de végétation dense et de mystère.
          </p>
        </div>
      </div>
    </div>
  
  <section class="section-services">
    <!-- Animal 1: Killer - Anaconda -->
    <div class="service1">      
      <article class="description">
        <p>
          Prénom : Killer <br>
          Race : Anaconda <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Forêts tropicales d'Amérique du Sud <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Killer']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Killer']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Killer']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Killer']['date_passage']))); ?>
  
        </div>
        <div class="like-button-container">
          <button id="increment-Killer" class="jaime-btn" data-animal="Killer">
            ❤️ J'aime
          </button>
        </div>
      </article>
      <article class="service">
        <img src=".././assets/jungle/anaconda.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">
  
    <!-- Animal 2: Garry - Jaguar -->
    <div class="service2">
      <article class="service">
        <img src=".././assets/jungle/jaguar.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
        <p>
          Prénom : Garry <br>
          Race : Jaguar <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Forêts tropicales d'Amérique du Sud <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Garry']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Garry']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Garry']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Garry']['date_passage']))); ?>
  
        </div>
        <div class="like-button-container">
          <button id="increment-Garry" class="jaime-btn" data-animal="Garry">
            ❤️ J'aime
          </button>
        </div>
      </article>
    </div>
    <hr class="service-divider">
  
    <!-- Animal 3: Kaki - Macaque -->
    <div class="service3">
      <article class="description">
        <p>
          Prénom : Kaki <br>
          Race : Macaque <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Forêts tropicales d'Asie <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Kaki']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Kaki']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Kaki']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Kaki']['date_passage']))); ?>
  
        </div>
        <div class="like-button-container">
          <button id="increment-Kaki" class="jaime-btn" data-animal="Kaki">
            ❤️ J'aime
          </button>
        </div>
      </article>
      <article class="service">
        <img src=".././assets/jungle/macaque.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">
  
    <!-- Animal 4: Spin - Perroquet Ara Rouge -->
    <div class="service4">
      <article class="service">
        <img src=".././assets/jungle/perroquet.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
        <p>
          Prénom : Spin <br>
          Race : Perroquet Ara Rouge <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Forêts tropicales d'Amérique du Sud <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Spin']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Spin']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Spin']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Spin']['date_passage']))); ?>
  
        </div>
        <div class="like-button-container">
          <button id="increment-Spin" class="jaime-btn" data-animal="Spin">
            ❤️ J'aime
          </button>
        </div>
      </article>
    </div>
    <hr class="service-divider">
  
    <!-- Animal 5: Rex - Tigre du Bengale -->
    <div class="service5">
      <article class="description">
        <p>
          Prénom : Rex <br>
          Race : Tigre du Bengale <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Forêts tropicales et mangroves d'Asie du Sud <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Rex']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Rex']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Rex']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Rex']['date_passage']))); ?>
        </div>
        
        <div class="like-button-container">
          <button id="increment-Rex" class="jaime-btn" data-animal="Rex">
            ❤️ J'aime
          </button>
        </div>
      </article>
      <article class="service">
        <img src=".././assets/jungle/tigre.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
  </section>

  <?php require_once '../template/footer.php'; ?>