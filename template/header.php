
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

<div class="login-container">
        <!-- Lien vers la page Admin, mais qui ne redirige pas encore -->
        <a href="../public/admin.php" class="admin-link">Admin</a>

        <div class="login-form">
            <form action="../../actions/verification.php" method="POST" id="login-form">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required />
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required />
                </div>

                <div class="form-group">
                    <label for="role">Rôle :</label>
                    <select name="role" id="role" required>
                        <option value="admin">Admin</option>
                        <option value="employee">Employé</option>
                        <option value="veterinarian">Vétérinaire</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary submit-btn">Se connecter</button>
            </form>
        </div>
    </div>

<header>
  <div class="background-image"></div>
  <div class="header-container">
    <!-- Logo section -->
    <div class="logo">
      <img src="../assets/logo/Arcadia-logo.png" alt="Arcadia Logo" />
    </div>

  <!-- Dynamic Navigation Menu -->
<nav class="header-nav">
    <ul>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>"><a href="../index.php">ACCUEIL</a></li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'desert.php' ? 'active' : '' ?>"><a href="../public/desert.php">Animaux et Habitats</a></li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : '' ?>"><a href="../public/services.php">SERVICES</a></li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'formulaire.php' ? 'active' : '' ?>"><a href="../public/Formulaire.php">CONTACT</a></li>
    </ul>
</nav>

  </div>
</header>
