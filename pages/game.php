<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />

  <title>EVALUATION-CRUD-PHP-AJAX-MSQL</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<?php

//Je récupère la session et le nom de l'utilisateur en session 
//et je mets la variable de session users dans une variable
session_start();
$user = $_SESSION['users'];


//Je verifie que ne la variable user contient bien un pseudo 
//si pas de pseudo je renvois à la page login et j'arrête la session
if (empty($user)) {
  header('Location:login.php');
  exit();
}

//Génération aléatoire des nombres
$nombre1 = random_int(1, 100);
$nombre2 = random_int(1, 100);

//Je calcule le résultat
$resultat = $nombre1 * $nombre2;

//Je déclare les variables à récupérer
$multiplication = "";
$reponse = "";
$statut = "";
$requete = array();


//Je me connect à la base de donnée
require_once('../functions/connexion.php');

//RECUPERATION DES DONNEES DU FORMULAIRE

//Je verifie que l'utilisateur a bien validé
if (isset($_GET['valider'])) {

  //Je mets les données dans les  variables précédement déclarées
  $multiplication = trim($_GET['multiplication']);
  $reponse = filter_input(INPUT_GET, 'reponse', FILTER_VALIDATE_INT);
  $statut = filter_input(INPUT_GET, 'statut', FILTER_VALIDATE_INT);
  $pseudo = trim($_GET['user']);

  //Je verifie que l'utilisateur a bien donné une réponse
  if (empty($reponse)) {
    $msgErreurReponse = "Entrez une réponse";
  }

  //Je convertis le statut selon la réponse de l'utilisateur
  if ($reponse === $statut) {
    $statut = 1;
  } else {
    $statut = 0;
  };
}


//Je verifie que le post contient bien les données a inserer dans la base de donnée
if (!empty($multiplication) && !empty($reponse) && !empty($user)) {

  //J'insere les données de l'utisitateur par une requête à la base de donnée
  $insert = $bdd->prepare('INSERT INTO tentatives(operation,reponse,statut,pseudo) VALUES (?,?,?,?)');
  $insert->execute([$multiplication, $reponse, $statut, $user]);
}


//J'affiche les données de l'utisitateur par une requête
if (!empty($multiplication) && !empty($reponse) && !empty($user)) {
  $requete = $bdd->prepare('SELECT * FROM tentatives WHERE pseudo=?');
  $requete->execute([$pseudo]);
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
          <a class="nav-link" href="logout.php">LOGOUT <span class="sr-only">(current)</span></a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="userActif">
    <h3>Bienvenue <?php echo $user; ?></he>
  </div>

  <div class="titreGame">Page de Jeux</div>

  <div class="container-jeu">
    <h3>Voici votre défi du jour!</h3>
    <div class="jeu"></div>
    <span id="nombre1"><?php echo $nombre1 ?></span>
    <span>x</span>
    <span id="nombre2"><?php echo $nombre2 ?></span>
  </div>


  <!-- Le formulaire-->
  <div class="form-reponse">

    <form action="" method="get">

      <div class="form-group px-4">
        <input type="hidden" class="form-control " name="user" value="<?php echo $user ?>" />
        <input type="hidden" class="form-control " name="id-reponse" value="" />
        <input type="hidden" class="form-control " name="multiplication" value="<?php echo $nombre1 . "x" . $nombre2 ?>" />
        <input type="hidden" class="form-control " name="statut" value="<?php echo $resultat ?>" />
        <label for="reponse"></label>
        <input type="number" class="form-control " id="reponse" name="reponse" placeholder="Entrez votre mot de passe " required />
      </div>
      <div class="form-group px-4">
        <button type="submit" class="btn btn-info btn-lg btn-block" id="btn" name="valider">Valider</button>
      </div>
      <p class="text-center text-danger alert">
        <small id="msgTentative"></small>
      </p>

    </form>
  </div>
  </div>

  <!-- Le tableau-->
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">MULTIPLICATION</th>
        <th scope="col">REPONSE</th>
        <th scope="col">CORRECT ?</th>
      </tr>
    </thead>
    <tbody class="myTbody">
      <?php

      //J'affiche les données de la requête Select dans le tableau grâce au foreach
      foreach ($requete as $user) {
      ?>
        <tr>

          <td><?php echo $user['id'] ?></td>
          <td><?php echo $user['operation'] ?></td>
          <td><?php echo $user['reponse'] ?></td>
          <td><?php echo $user['statut'] ?></td>

        <?php

      } ?>
        </tr>

    <tbody>

  </table>


  <!-- Optional JavaScript -->
</body>

</html>