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

//J'ouvre une session
session_start();



$pseudo = "";
$mdp = "";
$mdp2 = "";
$Checkbox = "";
$msgErreurPseudo = "";
$msgErreurMdp = "";
$msgErreurMdp2 = "";
$msgErreurMdpIdm = "";
$msgErreurCheckbox = "";

//Je me connect à la base de donnée
require_once('../functions/connexion.php');

//Je verifie que l'utilisateur a bien validé
if (isset($_POST['valider'])) {

    //Je mets les données dans des variable
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    $mdp2 = trim($_POST['mdp2']);

    //Je fais les vérification des champs à remplir
    if (empty($pseudo)) {
        $msgErreurPseudo = "Renseignez votre pseudo!";
    }
    if (empty($mdp)) {
        $msgErreurMdp = "Renseignez votre mot de passe!";
    }
    if (empty($mdp2)) {
        $msgErreurMdp2 = "Renseignez votre mot de passe";
    }
    if ($mdp != $mdp2) {
        $msgErreurMdpIdm = "Vos mots de passe ne sont pas identique!";
    }
    if (isset($Checkbox)) {
        $msgErreurCheckbox = "Veuillez accepter les conditions!";
    }


    //Je verifie que le post contient bien des données
    if (!empty($pseudo) && !empty($mdp) && ($mdp === $mdp2)  && !empty($msgErreurCheckbox)) {

        //J'insers le nouveau utilisateur dans la base de donnée par une requête
        $insert = $bdd->prepare('INSERT INTO users(pseudo,mdp) VALUES (?,?)');
        $insert->execute([$pseudo, $mdp]);

        //J'oriente à la page de login
        header('location:login.php');
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
        <div class="photo-card">
            <img class="photo" src="../assets/image/restaurant-690975_1280.jpg">
        </div>
        <div class="form-card mx-auto ">
            <div class=" titreForm ">
                <h1>CREER UN COMPTE</h1>
            </div>

            <!-- Le formulaire -->
            <form action="" method="post">

                <div class="form-group ">

                    <label for="psedo"></label>
                    <input type="text" class="form-control " name="pseudo" placeholder="Entrez votre psedo " value="" />
                    <div class='erreur'>
                        <?php echo $msgErreurPseudo; ?>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="mdp"></label>
                    <input type="password" class="form-control " name="mdp" placeholder="Entrez votre mot de passe " value="" />

                    <div class='erreur'>
                        <?php echo $msgErreurMdp; ?>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="mdp2"></label>
                    <input type="password" class="form-control " name="mdp2" placeholder="Entrez votre mot de passe " value="" />
                    <div class='erreur'>
                        <?php echo $msgErreurMdp2; ?>
                        <?php echo $msgErreurMdpIdm; ?>
                    </div>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="" name="Checkbox">
                    <label class="form-check-label" for="defaultCheck1">
                        Accepter les termes d'utilisation
                    </label>
                    <div class='erreur'>
                        <?php echo $msgErreurCheckbox; ?>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-info btn-lg btn-block mt-3" name="valider">S'enregistrer</button>
                </div>
                <div class="Userlogin mt-3">
                    <p>
                        Vous avez déjà un compte?<a href="login.php">Connectez-vous ici.</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    
</body>

</html>