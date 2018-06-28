<?php
include '../php/config.php';
session_start();
//On vérifie que la session correspond bien à un admin, sinon on déconnecte l'utilisateur.
if ($_SESSION['categorie'] !== 'admin') {
    session_destroy();
    header("Location: http://localhost:8888/index.html");
}
//Gestion des candidatures
if(isset($_POST)){
    if (isset($_POST['accepter'])) {
        $request = "UPDATE `NOUNOU` SET `candidature` = '0' WHERE `NOUNOU`.`idNounou` = " . key($_POST['accepter']) . ";";
        $result = mysqli_query($bdd, $request);
        $_POST = array();

    } elseif (isset($_POST['refuser'])) {
        $request = "DELETE FROM `NOUNOU` WHERE `NOUNOU`.`idNounou` =" . key($_POST['refuser']) . ";";
        $result = mysqli_query($bdd, $request);
        $request = "DELETE FROM `LANGUES` WHERE `LANGUES`.`idNounou` =" . key($_POST['refuser']) . ";";
        $result = mysqli_query($bdd, $request);
        $request = "DELETE FROM `UTILISATEUR` WHERE `UTILISATEUR`.`id_utilisateur` =" . key($_POST['refuser']) . ";";
        $result = mysqli_query($bdd, $request);
        $_POST = array();
    }

    if(isset($_POST['bloquer'])){
        $request = "UPDATE `NOUNOU` SET `blocage` = '1' WHERE `NOUNOU`.`idNounou` = " . key($_POST['bloquer']) . ";";
        $result = mysqli_query($bdd, $request);

        $_POST = array();
    } elseif (isset($_POST['debloquer'])){
        $request = "UPDATE `NOUNOU` SET `blocage` = '0' WHERE `NOUNOU`.`idNounou` = " . key($_POST['debloquer']) . ";";
        $result = mysqli_query($bdd, $request);

        $_POST = array();
    }


}


?>

<!DOCTYPE html>

<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tableau de Bord</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="container-fluid">
<header class="text-center container-fluid">
    <a href="../index.html">
        <img src="../img/rattle.png" class="float-left logo" alt="hochet">
    </a>
    <h1 class="titreaccueil">maNounou.com</h1>
    <h2 class="lead">Le meilleur site de recherche de nounous</h2>
</header>
<?php
if (isset($_SESSION["nom"]))
    echo("<div class='alert alert-info' role='alert'>
            Bienvenue à vous " . $_SESSION['nom'] . ", que voulez-vous faire?
        </div>");
?>

<div class="jumbotron">
    <!-- TODO Add "active" class for buttons -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <span class="navbar-brand">Tableau de Bord</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse float-right">
            <div class="navbar-nav">
                <p class="nav-item ml-4 mr-2">
                    <button type="button" id="nounou" class="btn btn-outline-info" onclick=affiche("gestion-nounou")>
                        Gestion des nounous
                    </button>
                </p>
                <p class="nav-item mr-2">
                    <button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("chiffre-affaire")>
                        Chiffre d'affaire
                    </button>
                </p>
                <p class="nav-item mr-2">
                    <a href="../php/deconnexion.php" ><button type="button" id="nounou" class="btn btn-outline-info">
                        Déconnexion
                        </button></a>
                </p>
            </div>
        </div>

    </nav>
    <hr class="my-4">

    <section class="container mt-1 mb-5">
        <h2 class="h3 lead">Rechercher une Nounou</h2>
        <br>
        <!-- RECHERCHER NOUNOU-->
        <form class="form row" method="POST" action="board_admin.php">
            <input class="form-control col-md-9" type="text" name="nomNounou" placeholder="Nom de la nounou">
            <br>
            <input class="btn btn-primary col-md-2 offset-md-1" type="submit" value="Rechercher">
        </form>

        <!-- TABLEAU PROFIL NOUNOU -->
        <div class="container visible">


            <?php


            if (isset($_POST['nomNounou']) && ($_POST['nomNounou'] != '')) {
                $nom = $_POST['nomNounou'];
                $requete = "SELECT e.num_resa, e.note, e.commentaire
    FROM EVALUATION e, RESERVATIONS r, UTILISATEURS u 
    WHERE e.num_resa = r.num_resa AND r.idNounou = u.id_utilisateur AND u.nom ='".$nom."';";
                $resultat = mysqli_query($bdd, $requete);

                $requete2 = "SELECT n.lien_photo, n.presentation
FROM NOUNOU n, UTILISATEURS u
WHERE n.idNounou=u.id_utilisateur AND u.nom='$nom'; ";
                $resultatphoto = mysqli_fetch_row(mysqli_query($bdd, $requete2));

                echo("<div class='card' style='width: 18rem;'>
                        <img class='card-img-top' src='../img/" . $resultatphoto[0] . "' alt='Card image cap'>
                              <div class='card-body'>
                                 <h5 class='card-title'>" . $nom . "</h5>
                                 <p class='card-text'>".$resultatphoto[1]."</p>");



                if ($resultat) {

                    while ($nounou = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
                        $resaNounou = $nounou['num_resa'];
                        $noteNounou = $nounou['note'];
                        $commentaireNounou = $nounou['commentaire'];



                        echo("<li class='list-group-item'>Réservation n° :" . $resaNounou . "</li>");
                        echo("<li class='list-group-item'>Note obtenue :" . $noteNounou . " <i class=\"material-icons\">star</i></li>");
                        echo("<li class='list-group-item'>Commentaire : " . $commentaireNounou . "</li>");
                        echo("</ul></div>");


                    }
                }

            }
            ?>
        </div>


    </section>


    <div id="gestion-nounou" class="hidden">

        <section class="my-3">
            <!--Nombre de nounous inscrites et acceptées-->
            <?php

            $requete = "SELECT * FROM NOUNOU WHERE candidature=0;";
            $resultat = mysqli_query($bdd, $requete);

            if ($resultat) {
                $nbrnounous = mysqli_num_rows($resultat);
                if ($nbrnounous != 0) {
                    echo("<p class='h5'>Vous avez " . $nbrnounous . " nounou(s) inscrite(s) sur la plateforme.<br></p>");
                } else {
                    echo("<p class='h5'>Aucune nounou n'est encore inscrite sur la plateforme.<br></p>");
                }
            }
            ?>

        </section>

        <section id="candidature my-3">
            <!-- NOUNOUS CANDIDATES -->


            <hr>
            <h2 class="h3">Gestion des Candidatures</h2>
            <br>
            <!-- Affichage du nombre de nounous candidates-->
            <?php

            $requete = "SELECT * FROM NOUNOU WHERE candidature=1;";
            $resultat = mysqli_query($bdd, $requete);

            if ($resultat) {

                $candidatures = mysqli_num_rows($resultat);
                if ($candidatures > 0) {
                    echo("<p class='h5'>Vous avez " . $candidatures . " candidature(s) de nounous</p>");
                } else {
                    echo("<p class='h5'>Il n'y a aucune candidature actuellement</p>");
                }
            }
            ?>



            <br/>
            <!-- Affichage tableau des candidatures avec ajouter/supprimer-->

            <?php
            $requete = "SELECT u.id_utilisateur, u.nom, u.prenom, n.age, n.annees_experience, n.presentation
                            FROM UTILISATEURS u, NOUNOU n
                            WHERE u.id_utilisateur=n.idNounou AND n.candidature = 1;";
            $resultat = mysqli_query($bdd, $requete);

            if (mysqli_num_rows($resultat) > 0) {

                echo("<table class='table'>
                    <thead>
                    <tr>
                        <th scope='col'>Nom</th>
                        <th scope='col'>Prénom</th>
                        <th scope='col'>Age</th>
                        <th scope='col'>Années d'expérience</th>
                        <th scope='col'>Présentation</th>
                        <th scope='col'>Modération</th>


                    </tr>
                    </thead>
                    <tbody>");
                $i = 0;

                while ($candidaturenounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {

                    $nom = $candidaturenounous['nom'];
                    $prenom = $candidaturenounous['prenom'];
                    $age = $candidaturenounous['age'];
                    $experience = $candidaturenounous['annees_experience'];
                    $presentation = $candidaturenounous['presentation'];

                    echo("<tr><td>" . $nom . "</td>");
                    echo("<td>" . $prenom . "</td>");
                    echo("<td>" . $age . "</td>");
                    echo("<td>" . $experience . "</td>");
                    echo("<td>" . $presentation . "</td>");
                    echo("<td>
                            <form method='post' action='board_admin.php'>
                                <input type='submit' name='accepter[" . $id . "]' id='nom' class='btn btn-outline-info' value='Accepter'>
                                <input type='submit' name='refuser[" . $id . "]' id='nom' class='btn btn-outline-warning' value='Refuser'>
                            </form>
                          </td>
                    </tr>");

                }
                echo("</tbody>
                </table>");
            }

            ?>


        </section>


        <section id="vue-nounou my-3">

            <h2 class="h3">Liste des nounous</h2>
            <!-- TABLEAU POUR REVENUS PAR NOUNOUS -->

            <?php
            $requete = "SELECT idNounou, revenus, blocage FROM NOUNOU WHERE candidature = 0 ORDER BY revenus DESC;";
            $resultat = mysqli_query($bdd, $requete);

            if ($resultat) {
                echo("
                        <table class='table'>
                            <thead>
                            <tr>
                                <th scope='col'>idNounou</th>
                                <th scope='col'>Revenus</th>
                                <th scope='col'>Etat</th>
                                <th scope='col'>Modération</th>
                
                            </tr>
                            </thead>
                            <tbody>");

                while ($revenusnounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
                    $idNounou = $revenusnounous['idNounou'];
                    $revenu = $revenusnounous['revenus'];
                    $blocage = $revenusnounous['blocage'];

                    echo("<tr><td>" . $idNounou . "</td>");
                    echo("<td>" . $revenu . "</td>");
                    if ($blocage == '0') {
                        echo("<td></td>");
                    } elseif ($blocage = '1') {
                        echo("<td>Bloquée</td>");
                    }
                    echo("<form method='post' action='board_admin.php'>");
                    if ($blocage == '0') {
                        echo("<td><input type='submit' name='bloquer[".$idNounou."]' class='btn btn-danger' value='Bloquer'></td></tr>");
                    } elseif ($blocage == '1') {
                        echo("<td><input type='submit' name='debloquer[".$idNounou."]' class='btn btn-danger' value='Débloquer'></td></tr>");
                    }

                }
                echo("</tbody>
                </table>");

            }


            ?>


        </section>

    </div>


    <!-- =============================-->


    <div id="chiffre-affaire" class="hidden">
        <!-- Insérer ici le php -->

            <?php
            $chiffreaffaire ="SELECT SUM(revenus) FROM NOUNOU;";
            $resultat = mysqli_fetch_row(mysqli_query($bdd, $chiffreaffaire));

                echo("Votre chiffre d'affaire s'élève à : " .$resultat[0]. "€.");

            ?>

    </div>


</div>

<script src="../js/affiche.js"></script>
<script src="../js/active.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>