<?php
session_start();
//On vérifie que la session correspond bien à un admin, sinon on déconnecte l'utilisateur.
if($_SESSION['categorie'] !== 'admin'){
    session_destroy();
    header("Location: http://localhost:8888/index.html");
}

?>

<!DOCTYPE html>
<?php
include '../php/config.php';
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

                <!-- NOUNOUS CANDIDATES -->

                    <!-- Affichage du nombre de nounous candidates-->
                <?php

                $requete = "SELECT * FROM NOUNOU WHERE candidature=1;";
                $resultat = mysqli_query($bdd, $requete);

                if ($resultat) {
                    $candidatures = mysqli_num_rows($resultat);
                    echo("Vous avez ". $candidatures . " candidature(s) de nounous");
                } else{
                    echo ("Il n'y a aucune candidature actuellement");
                }
                ?>

            </article>

            <article>
                    <!-- Affichage tableau des candidatures avec ajouter/supprimer-->



                <br/>

                <?php

                $requete = "SELECT * FROM NOUNOU WHERE candidature=0;";
                $resultat = mysqli_query($bdd, $requete);

                if ($resultat) {
                    $nbrnounous = mysqli_num_rows($resultat);
                    echo("Vous avez ". $nbrnounous . " nounous inscrites sur la plateforme");
                } else{
                    echo ("Aucune nounou n'est encore inscrite sur la plateforme");
                }
                ?>


                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Age</th>
                        <th scope="col">Années d'expérience</th>
                        <th scope="col">Présentation</th>
                        <th scope="col">Modération</th>


                    </tr>
                    </thead>
                    <tbody>

                    <?php
                $requete = "SELECT u.nom, u.prenom, n.age, n.annees_experience, n.presentation
                            FROM UTILISATEURS u, NOUNOU n
                            WHERE u.id_utilisateur=n.idNounou AND n.candidature = 1;";
                $resultat = mysqli_query($bdd, $requete);

                if ($resultat) {
                    while($candidaturenounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)){
                        $nom = $candidaturenounous['nom'];
                        $prenom = $candidaturenounous['prenom'];
                        $age = $candidaturenounous['age'];
                        $experience = $candidaturenounous['annees_experience'];
                        $presentation = $candidaturenounous['presentation'];

                        echo("<tr><td>".$nom."</td>");
                        echo("<td>".$prenom ."</td>");
                        echo("<td>".$age ."</td>");
                        echo("<td>".$experience ."</td>");
                        echo("<td>".$presentation ."</td>");
                        echo("<td><button type=\"button\" class=\"btn btn-outline-info\">Accepter</button>&nbsp;<button type=\"button\" class=\"btn btn-outline-warning\">Refuser</button></td></tr>");

                }
                ?>
                    </tbody>
                </table>



            </article>


            <h2 class="lead">Que voulez-vous faire?</h2>

            <ul class="nav">
                <li class="nav-item mr-2"><button type="button" class="btn btn-info">Traiter les candidatures</button></li>
                <li class="nav-item mr-2"><button type="button" class="btn btn-info">Rechercher une nounou</button></li>
                <li class="nav-item mr-2"><button type="button" class="btn btn-info">Nounous par revenus</button></li>


            </ul>
        </div>

        <!-- TABLEAU POUR REVENUS PAR NOUNOUS -->

        <table class="table">
            <thead>
            <tr>
                <th scope="col">idNounou</th>
                <th scope="col">Revenus</th>
                <th scope="col">Etat</th>
                <th scope="col">Modération</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $requete = "SELECT idNounou, revenus, blocage FROM NOUNOU WHERE candidature = 0 ORDER BY revenus DESC;";
            $resultat = mysqli_query($bdd, $requete);

            if ($resultat) {
                while($revenusnounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)){
                    $idNounou = $revenusnounous['idNounou'];
                    $revenu = $revenusnounous['revenus'];
                    $blocage = $revenusnounous['blocage'];

                    echo("<tr><td>".$idNounou."</td>");
                    echo("<td>".$revenu."</td>");
                    if($blocage == false){
                        echo ("<td></td>");
                    } elseif($blocage = true){
                        echo("<td>Bloquée</td>");
                    }
                    if ($blocage == false){
                        echo ("<td><button type=\"button\" class=\"btn btn-danger\">Bloquer</button></td></tr>");
                    } elseif ($blocage == true){
                        echo ("<td><button type=\"button\" class=\"btn btn-success\">Débloquer</button></td></tr>");
                    }

                }

            }}


            ?>

            </tbody>
        </table>


        <!-- =============================-->


        <!-- RECHERCHER NOUNOU-->

        <form method="POST" action="board_admin.php">
            <input type="text" name="nomNounou" value="Nom de la nounou">
            <input type="submit" value="Rechercher">
        </form>


        <!-- TABLEAU PROFIL NOUNOU -->

        <?php


        if(isset($_POST['nomNounou'])){
            $nom = $_POST['nomNounou'];
            $requete = "SELECT e.num_resa, e.note, e.commentaire
FROM EVALUATION e, RESERVATIONS r, UTILISATEURS u 
WHERE e.num_resa = r.num_resa AND r.idNounou = u.id_utilisateur AND u.nom =\"$nom\";";
            $resultat = mysqli_query($bdd, $requete);

            echo("<div class=\"card\" style=\"width: 18rem;\">
                    <img class=\"card-img-top\" src=\".../100px180/?text=Image cap\" alt=\"Card image cap\">
                          <div class=\"card-body\">
                             <h5 class=\"card-title\">".$nom."</h5>
                             <p class=\"card-text\">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                           </div>
                                <ul class=\"list-group list-group-flush\">");

            if ($resultat) {
                while($nounou = mysqli_fetch_array($resultat, MYSQLI_ASSOC)){
                    $resaNounou = $nounou['num_resa'];
                    $noteNounou = $nounou['note'];
                    $commentaireNounou = $nounou['commentaire'];
                    echo("<li class=\"list-group-item\>".$resaNounou."</li>");
                    echo("<li class=\"list-group-item\>".$noteNounou."</li>");
                    echo("<li class=\"list-group-item\>".$commentaireNounou."</li>");
                    echo("</ul></div>");



                }
            }




        }
        ?>



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