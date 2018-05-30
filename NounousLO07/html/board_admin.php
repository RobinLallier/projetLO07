<!DOCTYPE html>
<?php
include '../php/config.php';
?>
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tableau de Bord</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="container-fluid">
    <header class="text-center container-fluid">
        <a href="../index.html" >
            <img src="../img/rattle.png" class="float-left logo" alt="hochet">
        </a>
        <h1 class="titreaccueil">maNounou.com</h1>
        <h2 class="lead">Le meilleur site de recherche de nounous</h2>
    </header>
    <div class="jumbotron">
        <!-- TODO Add "active" class for buttons -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <span class="navbar-brand">Tableau de Bord</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse float-right">
                <div class="navbar-nav">
                    <p class="nav-item mr-2"><button type="button" id="nounou" class="btn btn-outline-info" onclick=affiche("gestion-nounou") >Gestion des nounous</button></p>
                    <p class="nav-item mr-2"><button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("chiffre-affaire") >Chiffre d'affaire</button></p>
                </div>
            </div>

        </nav>
        <hr class="my-4">



        <div id="gestion-nounou" class="hidden">

            <article>

                <?php

                $requete1 = "SELECT COUNT(*) FROM NOUNOU WHERE candidature=1;";
                $resultat1 = mysqli_query($bdd, $requete1);

                if ($resultat1) {
                    $candidatures = mysqli_num_rows($resultat1);
                    echo("Vous avez ". $candidatures . " candidature(s) de nounous");
                } else{
                    echo ("Il n'y a aucune candidature actuellement");
                }
                ?>

                <br/>

                <?php

                $requete2 = "SELECT COUNT(*) FROM NOUNOU WHERE candidature=0;";
                $resultat2 = mysqli_query($bdd, $requete2);

                if ($resultat2) {
                    $nbrnounous = mysqli_fetch_rows($resultat2);
                    echo("Vous avez ". $nbrnounous . " nounous inscrites sur la plateforme");
                } else{
                    echo ("Aucune nounou n'est encore inscrite sur la plateforme");
                }
                ?>

            </article>
            <h2 class="lead">Que voulez-vous faire?</h2>

            <ul class="nav">
                <li class="nav-item mr-2"><button type="button" class="btn btn-info">Traiter les candidatures</button></li>
                <li class="nav-item mr-2"><button type="button" class="btn btn-info">Rechercher une nounou</button></li>
                <li class="nav-item mr-2"><button type="button" class="btn btn-info">Nounous par revenus</button></li>
            </ul>
        </div>


        <div id="chiffre-affaire" class="hidden">
            <!-- Insérer ici le php -->
            <p>Vous avez gagné 10 000€ ce mois-ci.</p>
        </div>


    </div>

    <script src="../js/affiche.js"></script>
    <script src="../js/active.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
