<?php 
include '../template/header.php';
include '../config/database.php'; // Connexion à la base de données avec PDO


try {
    $pdo = new PDO("mysql:host=localhost;dbname=Arcadia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exemple de requête SQL avec un paramètre (nom d'animal ou prénom)
    $sql = "SELECT * FROM animal WHERE prenom IN (:names)"; // Modifie cette requête en fonction de ta base de données

    $query = $pdo->prepare($sql);

    // Si $animalNames est un tableau, transforme-le en une chaîne de noms pour la requête
    $animalNames = ['Léo', 'Tigrou']; // Exemple de tableau de prénoms
    $namesParam = implode(",", array_fill(0, count($animalNames), "?"));
    $sql = "SELECT * FROM animal WHERE prenom IN ($namesParam)";
    $query = $pdo->prepare($sql);

    // Exécute la requête avec les noms d'animaux
    $query->execute($animalNames);

    // Récupère tous les résultats
    $animals = $query->fetchAll(PDO::FETCH_ASSOC);

    // Organise les données par prénom
    $animalsByName = [];
    foreach ($animals as $animal) {
        $animalsByName[$animal['prenom']] = $animal;
    }

    // Affichage pour vérification
    foreach ($animalsByName as $prenom => $animal) {
        echo "<p>Prénom : " . htmlspecialchars($prenom) . "</p>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link  rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
  
<div class="background-section-savane">
    <div class="container service-container">
        <div class="row">
            <nav class="col-md-3 service-nav"> 
                <?php
                // Tableau associatif pour les pages et leurs noms
                $pages = [
                    'desert.php' => 'Désert',
                    'jungle.php' => 'Jungle',
                    'mountain.php' => 'Montagne',
                    'marais.php' => 'Marais',
                    'savane.php' => 'Savane'
                ];
                $current_page = basename($_SERVER['PHP_SELF']);
                ?>
                <ul>
                    <?php foreach ($pages as $file => $name): ?>
                        <li class="<?= $current_page === $file ? 'active' : '' ?>">
                            <a href="<?= $file ?>"><?= $name ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="col-md-9 content animals-intro">
                <h1 class="animals-title">Savane</h1>
                <p class="intro-animals">
                    Bienvenue dans la Savane, un vaste horizon de beauté naturelle au cœur de notre zoo. Découvrez cet habitat emblématique où l'éléphant d'Afrique, la girafe, le guépard, le lion, le rhinocéros et le zèbre évoluent en harmonie.<br><br>
                    Parcourez ces étendues sauvages où chaque pas révèle la majesté de la vie animale. Plongez dans ce monde fascinant où chaque créature incarne la splendeur de la vie sauvage de la Savane.
                </p>
            </div>
        </div>
    </div>
</div>

    <section class="section-services">
      <!-- Animal 1: Tembo - Élephant d'Afrique -->
      <div class="service1">      
        <article class="description">
  <p>
    Prénom : Tembo <br>
    Race : Éléphant d'Afrique <br>
            <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
            </p>
          <div style="display: none">
    Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['Tembo']['etat_animal']); ?> <br>
            Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Tembo']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Tembo']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Tembo']['date_passage']))); ?>
  
          </div>
          <div class="like-button-container">
            <button id="increment-Tembo" class="jaime-btn" data-animal="Tembo">
              ❤️ J'aime
            </button>
          </div>
        </article>
        <article class="service">
          <img src=".././assets/savane/elephant.jpg" onclick="agrandirImage(this)" />
        </article>
      </div>
      <hr class="service-divider">
  
      <!-- Animal 2: Jasiri - Girafe -->
      <div class="service2">
        <article class="service">
          <img src=".././assets/savane/girafe.jpg" onclick="agrandirImage(this)" />
        </article>
        <article class="description">
  <p>
    Prénom : Jasiri <br>
    Race : Girafe <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
  <div style="display: none">
    Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['Jasiri']['etat_animal']); ?> <br>
              Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Jasiri']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Jasiri']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Jasiri']['date_passage']))); ?>
  
          </div>
             <!-- Animal 4: Kito - Jeune Girafe -->
          <p>
    Prénom : Kito <br>
    Race : Girafe (Jeune) <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
  <div style="display: none">
    Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['Kito']['etat_animal']); ?> <br>
            Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Kito']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Kito']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Kito']['date_passage']))); ?>
  
          </div>
          <div class="like-button-container">
            <button id="increment-JasiriKito" class="jaime-btn" data-animal="JasiriKito">
              ❤️ J'aime
            </button>
          </div>
        </article>
      </div>
      <hr class="service-divider">
  
      <!-- Animal 4: Raja - Guépard -->
      <div class="service3">
        <article class="description">
  <p>
    Prénom : Raja <br>
    Race : Guépard <br>
              <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
              </p>
          <div style="display: none">
    Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['Raja']['etat_animal']); ?> <br>
  Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Raja']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Raja']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Raja']['date_passage']))); ?>
          </div>
          <div class="like-button-container">
            <button id="increment-Raja" class="jaime-btn" data-animal="Raja">
              ❤️ J'aime
            </button>
          </div>
        </article>
        <article class="service">
          <img src=".././assets/savane/guepard.jpg" onclick="agrandirImage(this)" />
        </article>
      </div>
      <hr id="lion" class="service-divider">
  
      <!-- Animal 5: Simba - Lion -->
      <div class="service4">
        <article class="service">
          <img src=".././assets/savane/zèbre.jpg" onclick="agrandirImage(this)" />
        </article>
        <article class="description">
  <p>
    Prénom : Simba <br>
    Race : Lion <br>
           <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
            </p>
          <div style="display: none">
            Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['Simba']['etat_animal']); ?> <br>
            Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Simba']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Simba']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Simba']['date_passage']))); ?>
          </div>
          <div class="like-button-container">
            <button id="increment-Simba" class="jaime-btn" data-animal="Simba">
              ❤️ J'aime
            </button>
          </div>
        </article>
      </div>
      <hr class="service-divider">
  
      <!-- Animal 6: RhinoFamily - Rhinocéros -->
      <div class="service5">
        <article class="description">
  <p>
    Prénom : Rhino, Rina et Rocco <br>
    Race : Rhinocéros <br>
             <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
             </p>
          <div style="display: none">
              Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['RhinoFamily']['etat_animal']); ?> <br>
            Nourriture proposée : <?php echo htmlspecialchars($animalsByName['RhinoFamily']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['RhinoFamily']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['RhinoFamily']['date_passage']))); ?>
          </div>
          <div class="like-button-container">
            <button id="increment-RhinoFamily" class="jaime-btn" data-animal="RhinoFamily">
              ❤️ J'aime
            </button>
          </div>
        </article>
        <article class="service">
          <img src=".././assets/savane/rhinoceros.jpg" onclick="agrandirImage(this)" />
        </article>
      </div>
      <hr class="service-divider">
  
      <!-- Animal 7: Zuri - Zèbre -->
      <div class="service6">
        <article class="service">
          <img src=".././assets/savane/zèbre.jpg" onclick="agrandirImage(this)"/>
        </article>
        <article class="description">
      <p>
    Prénom : Zara <br>
    Race : Zèbre <br>
               <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
               </p>
          <div style="display: none">
              Habitat : Savane <br>
            État de l'animal : <?php echo htmlspecialchars($animalsByName['Zuri']['etat_animal']); ?> <br>
            Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Zuri']['nourriture_proposee']); ?> <br>
            Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Zuri']['grammage_nourriture']); ?> <br>
            Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Zuri']['date_passage']))); ?>
          </div>
          <div class="like-button-container">
            <button id="increment-Zuri" class="jaime-btn" data-animal="Zuri">
              ❤️ J'aime
            </button>
          </div>
        </article>
      </div>
      <hr class="service-divider">
    </section>
  </div>
  
  <?php
  require_once '../template/footer.php';
  ?>
  </body>
  </html>