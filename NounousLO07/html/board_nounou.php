<?php
include("../php/config.php");
include("../php/php_class/Disponibilite.php");
session_start();
//On vérifie que la session correspond bien à un parent, sinon on déconnecte l'utilisateur.
if ($_SESSION['categorie'] !== 'nounou') {
    session_destroy();
    header("Location: http://localhost:8888/index.html");
}
$ajout = false;

if (isset($_POST["date"]) && !empty($_POST["date"])) {
    $dispo_ponctu = new Disponibilite($_SESSION["id"], $_POST["date"], $_POST["heure-debut"], $_POST["heure-fin"]);
    $dispo_ponctu->addToDatabase($bdd, false);
    $ajout = true;
} elseif (isset($_POST["jour"]) && !empty($_POST["jour"])) {
    foreach ($_POST["jour"] as $jour) {
        $dispo_recu = new Disponibilite($_SESSION["id"], $_POST["jour"][0], $_POST["heure-debut"], $_POST["heure-fin"], 1);
        $dispo_recu->addToDatabase($bdd, true);
        $ajout = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tableau de Bord</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
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
if ($ajout) {
    echo("<div class='alert alert-success' role='alert'>
                Disponibilité correctement ajoutée!
</div>");
}
?>

<div class="jumbotron">
    <nav class="navbar navbar-expand-lg navbar-light">
        <span class="navbar-brand">Tableau de Bord</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ">
            <div class="navbar-nav">
                <p class="nav-item mr-2">
                    <button type="button" id="nounou" class="btn btn-outline-info" onclick=affiche("dispo-simple")>
                        Ajouter une disponibilité ponctuelle
                    </button>
                </p>
                <p class="nav-item mr-2">
                    <button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("dispo-recurrente")>
                        Ajouter une disponibilité récurrente
                    </button>
                </p>
                <p class="nav-item mr-2">
                    <button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("planning")>Voir
                        Planning
                    </button>
                </p>
            </div>
        </div>

    </nav>
    <hr class="my-4">


    <div id="dispo-simple" class="hidden">

        <h2 class="lead">Ajouter une Disponibilité ponctuelle</h2>

        <!-- INSERER FORMULAIRE DE DISPONIBILITE PONCTUELLE -->
        <form class="form container" method="post">
            <fieldset class="form-group">
                <label for="date">Choisissez la date de votre disponibilité : </label>
                <input class="form-control" type="date" name="date" min="2018-06-01" max="2018-12-31">
            </fieldset>
            <div class="form-row">
                <div class="form-group col-md-5 ">
                    <label for="heure-debut">Entrez votre heure de début :</label>
                    <select name="heure-debut" class="form-control ">
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                    </select>
                </div>

                <div class="form-group col-md-5 offset-md-2">
                    <label for="heure-fin" class="">Entrez votre heure de fin :</label>
                    <select name="heure-fin" class="form-control">
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter Disponibilité</button>
        </form>


    </div>


    <div id="dispo-recurrente" class="hidden">

        <h2 class="lead">Ajouter une disponibilité récurrente</h2>
        <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE RECURRENTE -->

        <form class="form container" method="post" action="board_nounou.php">
            <fieldset class="form-group">
                <label for="jour">Cochez le jour de la semaine où vous êtes disponible :</label>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios1" value="lundi">
                    <label class="form-check-label" for="gridRadios1">
                        Lundi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios2" value="mardi">
                    <label class="form-check-label" for="gridRadios2">
                        Mardi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios3" value="mercredi">
                    <label class="form-check-label" for="gridRadios3">
                        Mercredi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios4" value="jeudi">
                    <label class="form-check-label" for="gridRadios4">
                        Jeudi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios5" value="vendredi">
                    <label class="form-check-label" for="gridRadios5">
                        Vendredi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios6" value="samedi">
                    <label class="form-check-label" for="gridRadios6">
                        Samedi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour[]" id="gridRadios7" value="dimanche">
                    <label class="form-check-label" for="gridRadios7">
                        Dimanche
                    </label>
                </div>
            </fieldset>
            <div class="form-row">
                <div class="form-group col-md-5 ">
                    <label for="heure-debut">Entrez votre heure de début :</label>
                    <select name="heure-debut" class="form-control ">
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                    </select>
                </div>

                <div class="form-group col-md-5 offset-md-2">
                    <label for="heure-fin" class="">Entrez votre heure de fin :</label>
                    <select name="heure-fin" class="form-control">
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter Disponibilité</button>


        </form>
    </div>


    <div id="planning" class="hidden">

        <h2 class="h3 lead">Votre planning</h2>

        <?php

        $requete = "SELECT r.num_resa, r.type_resa, u.nom FROM RESERVATION as r, UTILISATEUR as u, PARENT as p WHERE r.idNounou='" . $_SESSION['id'] . "',  = 0 ;";
        $resultat = mysqli_query($bdd, $requete);

        if ($resultat) {
            echo("
                        <table class=\"table\">
                            <thead>
                            <tr>
                                <th scope=\"col\">idNounou</th>
                                <th scope=\"col\">Revenus</th>
                                <th scope=\"col\">Etat</th>
                                <th scope=\"col\">Modération</th>
                
                            </tr>
                            </thead>
                            <tbody>");

            while ($revenusnounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
                $idNounou = $revenusnounous['idNounou'];
                $revenu = $revenusnounous['revenus'];
                $blocage = $revenusnounous['blocage'];

                echo("<tr><td>" . $idNounou . "</td>");
                echo("<td>" . $revenu . "</td>");
            }
        }
        ?>


    </div>

</div>

<script src="../js/affiche.js"></script>

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
