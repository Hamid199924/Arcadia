
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ZooArcadia</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="../assets/css/index.css">
     
</head>
<body>

<header>
  <div class="background-image"></div>
  <div class="header-container">
    <!-- Logo section -->
    <div class="logo">
      <img src=".././assets/logo/Arcadia-logo.png" alt="Arcadia Logo" />
    </div>

    <!-- Dynamic Navigation Menu -->
    <?php
    // Liste des pages avec leurs titres et chemins
    $navItems = [
        'index.php' => ['ACCUEIL', '../../index.php'],
        'desert.php' => ['Animaux & Habitats', '../../public/desert.php'],
        'services.php' => ['SERVICES', '../../public/services.php'],
        'formulaire.php' => ['CONTACT', '../../public/formulaire.php'],
        'connexion.php' => ['CONNEXION', '../../public/connexion.php']
       ];

    // Obtenir la page en cours
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <nav class="header-nav">
      <ul>
        <?php foreach ($navItems as $page => $info): ?>
          <li class="<?= ($current_page == $page) ? 'active' : ''; ?>">
            <a href="<?= $info[1]; ?>"><?= $info[0]; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</header>
