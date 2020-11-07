<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Ionic Icons -->
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />

  <title>EVALUATION-CRUD-PHP-AJAX-MSQL</title>

</head>

<?php
//Je démarre une session
session_start();


$pseudo = "";
$mdp = "";
$msgErreurPseudo = "";
$user = "";


//Je me connect à la base de donnée
require_once('../functions/connexion.php');

//Je verifie que l'utilisateur a bien validé sa saisie
if (isset($_POST['connexion'])) {

  //Je mets les données dans les variables déclarées précédement
  $pseudo = trim($_POST['pseudo']);
  $mdp = trim($_POST['mdp']);

  //Je mets les données la variable pseudo en session pour la récupérer dans la page game 
  $_SESSION['users'] = $pseudo;
}

//Je verifie que les variables ne sont pas vide
if (!empty($pseudo) && !empty($mdp)) {

  //Je verifie s'il est dans la base de donnée
  $requete = ("SELECT pseudo, mdp FROM users Where pseudo= '$pseudo' and mdp='$mdp'");
  $user = $bdd->query($requete)->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    //Si le  pseudo et le mot de passe exist j'oriente vers le les multiplication
    header('location:game.php');
  } else {
    //Si le mot de passe et le pseudo n'exist pas j'affiche le message
    $msgErreurPseudo = "User inconnu!";
  }
}

?>

<body>
  <!-- La bar de navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark" style=" background-color:#00838f;">
    <img class="navbar-brand" src="../assets/image/easter-2168521_1920.jpg" alt="Logo" />

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </nav>


  <div class="container mt-4">

    <div class="formLogin-card mx-auto ">
      <div>
        <ion-icon class="lock-open" name="lock-open"></ion-icon>
      </div>

      <!-- Le formulaire -->
      <form method="POST" id="formLogin">
        <div class="erreurLogin">
          <?php echo $msgErreurPseudo ?>
        </div>
        <input type="hidden" name="id">
        <div class="form-group px-4 ">
          <label for="pseudo "></label>
          <input type="text " class="form-control " name="pseudo" placeholder="Entrez votre pseudo de connexion " />
        </div>
        <div class="form-group px-4">
          <label for="mdp "></label>
          <input type="password" class="form-control " name="mdp" placeholder="Entrez votre mot de passe " />

        </div>
        <div class="form-group px-4">
          <button type="submit" class="btn btn-info btn-lg btn-block" name="connexion">Connexion</button>

        </div>

        <div class="Userlogin mt-3 px-3">
          <p>Vous n'avez pas de compte compte?<a href="register.php ">Inscrivez-vous ici.</a>
          </p>
        </div>
    </div>
    </form>
  </div>
  </div>




  <!-- Optional JavaScript -->
  
</body>

</html>