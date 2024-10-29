<?php
 // Inclure le fichier de connexion à la base de données
include_once "config/database.php";



 //Sélectionne les avis validés
include './template/header.php';

?>

<div class="background-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="presentation-container">
          <div class="text-container">
            <h1>Bienvenue à Arcadia</h1>
            <p>
            Bienvenue à Arcadia, le zoo où la nature prend vie !
            Plongez dans un monde fascinant, où la richesse des habitats 
            se mêle à la diversité extraordinaire de la faune sauvage.<br />

            Explorez la majesté de la savane, où le rugissement lointain des lions résonne dans l'air chaud, 
            tandis que les éléphants majestueux traversent tranquillement les vastes plaines dorées. 
            Laissez-vous émerveiller par la grâce des girafes, 
            déployant leurs longs cous pour atteindre 
            les feuilles les plus hautes des acacias.
              <br />

              Dans les profondeurs énigmatiques de la jungle, 
              croisez le regard perçant des tigres, maîtres indomptables de cette canopée mystérieuse.
               Laissez-vous envoûter par les cris des singes hurleurs 
               et la splendeur chatoyante des aras aux plumages éclatants.
              <br />

              En gravissant les sommets accidentés de nos montagnes, 
              entrez dans le royaume secret des bouquetins et des chamois,
               véritables maîtres de l’escalade sur les parois escarpées.
              <br />

              Plongez dans l’atmosphère envoûtante du désert, où le cobra royal trône en souverain solitaire.
               Admirez la résistance exemplaire des dromadaires, véritables symboles de l’adaptation aux conditions extrêmes,
                et laissez-vous captiver par le regard vif du fennec, la rapidité de la vipère du désert, 
                et la tranquillité du puissant iguane.
              <br />

              Enfin, découvrez les marais luxuriants, 
              où les hippopotames se prélassent paisiblement au milieu des roseaux,
               ajoutant une touche de sérénité à ce paysage aquatique enchanteur.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="image-container">
          <img id="main-image" src="./assets/jungle/tigre.jpg" alt="Tigre" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
  <div class="centered-section">
    <h2>Explorez la diversité de nos habitats</h2>
    <p>
      Rencontrez nos animaux emblématiques de la savane, des marais et des
      montagnes, et plongez dans leurs mondes fascinants.
    </p>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="rectangle">
          <img
            src="./assets/savane/savannah-lion.jpg"
            alt="Image 1"
            class="image img-fluid"
          />
          <div class="description-contain">
            <p>
              Rencontrez le roi de la savane - le lion. Découvrez sa majesté
              et sa puissance
            </p>
            <a href="./savane.php#lion"
              >En savoir plus...<img
                src="./assets/logo/iconeLien.png"
                alt="Logo En Savoir Plus"
            /></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="rectangle">
          <img
            src="./assets/marais/crocodilenil.jpg"
            alt="Image 2"
            class="image img-fluid"
          />
          <div class="description-contain">
            <p>Explorez le monde mystérieux des crocodiles des marais</p>
            <a href="/marais.php#croco"
              >En savoir plus...<img
                src="./assets/logo/iconeLien.png"
                alt="Logo En Savoir Plus"
            /></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="rectangle">
          <img
            src="./assets/montagne/loup.jpg"
            alt="Image 3"
            class="image img-fluid"
          />
          <div class="description-contain">
            <p>
              Plongez dans l'essence majestueuse du loup gris, maître des forêts sauvages
            </p>
            <a href="./mountain.php#loup"
              >En savoir plus...<img
                src="./assets/logo/iconeLien.png"
                alt="Logo En Savoir Plus"
            /></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="transparent-rectangle">
      <h3>Laisser un avis</h3>

<form id="avis_form">
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" />
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire :</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-submit">Laisser un avis</button>
        </form>
        <!-- div for message -->
    </div>
  </div>
     
  <?php include './template/footer.php'; ?>


