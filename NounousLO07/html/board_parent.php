<?php
session_start();
//On vérifie que la session correspond bien à un parent, sinon on déconnecte l'utilisateur.
if ($_SESSION['categorie'] !== 'parent') {
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
                    <button type="button" id="nounou" class="btn btn-outline-info" onclick=affiche("garde-ponctuelle")>
                        Garde Ponctuelle
                    </button>
                </p>
                <p class="nav-item mr-2">
                    <button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("garde-recurrente")>Garde
                        Récurrente
                    </button>
                </p>
                <p class="nav-item mr-2">
                    <button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("garde-etrangere")>Garde
                        Étrangère
                    </button>
                </p>
            </div>
        </div>

    </nav>
    <hr class="my-4">


    <div class="section-reservation visible">
        <?php

        $request = "SELECT DISTINCT u.nom, u.prenom, r.heure_debut, r.heure_fin, r.type_resa, r.jour, r.date, r.num_resa
                    FROM RESERVATIONS as r, PARENTS as p, UTILISATEURS as u
                    WHERE r.idParents = '".$_SESSION['id']."' 
                    AND u.id_utilisateur = r.idNounou";
        $request = mysqli_query($bdd, $request);
        if( mysqli_num_rows($request) >= 1){

            echo ("<h2 class='py-4'> Vos Réservations</h2>");

            echo("<table class='table'>
                    <thead>
                    <tr>
                        <th scope='col'>Nom de la Nounou</th>
                        <th scope='col'>Jour de la garde</th>
                        <th scope='col'>Heure de début</th>
                        <th scope='col'>Heure de fin</th>
                        <th scope='col'>Note</th>
                        <th scope='col'>Commentaire</th>
                        <th scope='col'>Évaluer</th>
                    </tr>
                    </thead>
                    <tbody>");
            while($result= mysqli_fetch_array($request)){
                echo("<tr><td>" . $result['nom'] . " ".$result['prenom']."</td>");
                if(!empty($result['jour'])){
                    echo("<td>" . $result['jour'] . "</td>");
                }
                else echo("<td>" . $result['date'] . "</td>");

                echo("<td>" . $result['heure_debut'] . "</td>");
                echo("<td>" . $result['heure_fin'] . "</td>");

                echo("<td>
                        <form method='post' action='board_parent.php'>
                        <input type='hidden' name='num_resa' value='".$result['num_resa']."' >
                        <select name='heure_debut' class='form-control '>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                      </td>");
                echo("<td><input type='text' name='commentaire'></td> ");
                echo("<td><input class='btn btn primary' type='submit' name='eval' value='Évaluer la garde'></td></form></tr>");

            }
            echo("</tbody> </table>");
        }
        ?>
    </div>


    <?php
    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'recu') {
            $resa = "INSERT INTO RESERVATIONS(type_resa, idParents, idNounou, heure_debut, heure_fin, jour) 
                        VALUES ('" . $_POST['type'] . "', '" . $_POST['idParents'] . "', '" . $_POST['idNounou'] . "'
                        , '" . $_POST['heure_debut'] . "', '" . $_POST['heure_fin'] . "', '" . $_POST['jour'] . "')";
            if ($result = mysqli_query($bdd, $resa)) {
                echo("<div class='alert alert-success' role='alert'>
                        Votre réservation a été correctement effectuée
                    </div>");
            }
        } elseif ($_POST['type'] == 'ponctuelle') {
            $resa = "INSERT INTO RESERVATIONS(type_resa, idParents, idNounou, heure_debut, heure_fin, date) 
                        VALUES ('" . $_POST['type'] . "', '" . $_POST['idParents'] . "', '" . $_POST['idNounou'] . "'
                        , '" . $_POST['heure_debut'] . "', '" . $_POST['heure_fin'] . "', '" . $_POST['date'] . "')";
            if ($result = mysqli_query($bdd, $resa)) {
                echo("<div class='alert alert-success' role='alert'>
                        Votre réservation a été correctement effectuée
                    </div>");
            }
        } elseif ($_POST['type'] == 'etrangere') {
            $resa = "INSERT INTO RESERVATIONS(type_resa, idParents, idNounou, heure_debut, heure_fin, jour) 
                        VALUES ('" . $_POST['type'] . "', '" . $_POST['idParents'] . "', '" . $_POST['idNounou'] . "'
                        , '" . $_POST['heure_debut'] . "', '" . $_POST['heure_fin'] . "', '" . $_POST['jour'] . "')";
            if ($result = mysqli_query($bdd, $resa)) {
                echo("<div class='alert alert-success' role='alert'>
                        Votre réservation a été correctement effectuée
                    </div>");
            }
        }
    }

    ?>

    <div class="visible">
        <?php
        if (isset($_POST)) {
            if (isset($_POST['ponctu'])) {
                $request = "SELECT n.idNounou 
                            FROM NOUNOU as n, PARENTS as p, DISPONIBILITES as d, UTILISATEURS as u1, UTILISATEURS as u2 
                            WHERE d.date = '" . $_POST['date'] . "' 
                            AND  u1.id_utilisateur = ".$_SESSION['id']." 
                            AND u2.id_utilisateur = n.idNounou 
                            AND u1.ville = u2.ville 
                            AND d.heure_debut <= " . $_POST['heure_debut'] . " 
                            AND d.heure_fin >= " . $_POST['heure_fin'] . "; ";
                echo("<h2>$request</h2>");
                $result = mysqli_query($bdd, $request);


                if (mysqli_num_rows($result) >= 1) {
                    echo("<h2 class='py-4'> Choisissez la nounou qui vous convient :</h2>");

                    while ($nounou = mysqli_fetch_array($result)) {

                        echo("<div class='container' >
                            <img class='float-right w-25' src=''../img/" . $nounou['lien_photo'] . "' alt='Card image cap'>
                            <div>
                                <h5>" . $nounou['prenom'] . " " . $nounou['nom'] . "</h5>
                                <ul>
                                    <li>Expérience : " . $nounou['annees_experience'] . " ans</li>
                                    <li>Age : " . $nounou['age'] . " ans</li>
                                    <li>Présentation : " . $nounou['presentation'] . "</li>
                                </ul>
                                <br><br><br><br>");

                        echo("<form class='form' method='post' action='board_parent.php'>
                                <input type='hidden' class='form-control' name='type' value='ponctuelle'>
                                <input type='hidden' class='form-control' name='idParents' value='".$_SESSION['id']."' >
                                <input type='hidden' class='form-control' name='idNounou' value='".$nounou['idNounou']."' >
                                <input type='hidden' class='form-control' name='date' value='".$_POST['date']."' >
                                <input type='hidden' class='form-control' name='heure_debut' value='".$_POST['heure_debut']."'>
                                <input type='hidden' class='form-control' name='heure_fin' value='".$_POST['heure_fin']."'>
                                <input type='submit' class='btn btn-primary'  value='Réserver'>
                            </form>");
                    }
                } else echo("<h2> Nous sommes désolé, aucune nounou n'est disponible à cet horaire.</h2>");




            } elseif (isset($_POST['recu'])) {
                $request = "SELECT DISTINCT n.idNounou, u2.nom, u2.prenom, n.lien_photo, n.presentation, n.annees_experience, n.age
                            FROM NOUNOU as n, PARENTS as p, DISPONIBILITES as d, UTILISATEURS as u1, UTILISATEURS as u2 
                            WHERE u1.id_utilisateur = ".$_SESSION['id']." 
                            AND u2.id_utilisateur = n.idNounou 
                            AND d.idNounou = n.idNounou
                            AND u1.ville = u2.ville 
                            AND d.recurrence = 1 
                            AND d.jour = '" . $_POST['jour'] . "' 
                            AND d.heure_debut <= " . $_POST['heure_debut'] . " 
                            AND d.heure_fin >= " . $_POST['heure_fin'] . "; ";
                $result = mysqli_query($bdd, $request);

                if (mysqli_num_rows($result) >= 1) {
                    echo("<h2 class='py-4'> Choisissez la nounou qui vous convient :</h2>");

                    while ($nounou = mysqli_fetch_array($result)) {

                        echo("<div class='container' >
                            <img class='float-right w-25' src='../img/" . $nounou['lien_photo'] . "' alt='Card image cap'>
                            <div>
                                <h5>" . $nounou['prenom'] . " " . $nounou['nom'] . "</h5>
                                <ul>
                                    <li>Expérience : " . $nounou['annees_experience'] . " ans</li>
                                    <li>Age : " . $nounou['age'] . " ans</li>
                                    <li>Présentation : " . $nounou['presentation'] . "</li>
                                </ul>
                                <br><br><br><br>");

                        echo("<form class='form' method='post' action='board_parent.php'>
                                <input type='hidden' class='form-control' name='type' value='recu'>
                                <input type='hidden' class='form-control' name='idParents' value='".$_SESSION['id']."' >
                                <input type='hidden' class='form-control' name='idNounou' value='".$nounou['idNounou']."' >
                                <input type='hidden' class='form-control' name='jour' value='".$_POST['jour']."' >
                                <input type='hidden' class='form-control' name='heure_debut' value='".$_POST['heure_debut']."'>
                                <input type='hidden' class='form-control' name='heure_fin' value='".$_POST['heure_fin']."'>
                                <input type='submit' class='btn btn-primary'  value='Réserver'>
                            </form>");

                    }
                }
                else
                    echo("<h2> Nous sommes désolé, aucune nounou n'est disponible à cet horaire.</h2>");



            } elseif (isset($_POST['etranger'])){
                $request = "SELECT DISTINCT n.idNounou, n.lien_photo, n.presentation, n.annees_experience, n.age, u2.nom, u2.prenom 
                            FROM NOUNOU as n, DISPONIBILITES as d, UTILISATEURS as u1, UTILISATEURS as u2, LANGUES as l
                            WHERE u1.id_utilisateur = ".$_SESSION['id']." 
                            AND u2.id_utilisateur = n.idNounou 
                            AND u1.ville = u2.ville 
                            AND d.recurrence = 1 
                            AND l.langue = '". $_POST['langue'] ."'
                            AND l.idNounou = n.idNounou;";

                $result = mysqli_query($bdd, $request);

                if (mysqli_num_rows($result) >= 1) {
                    echo("<h2 class='py-4'> Choisissez la nounou qui vous convient :</h2>");
                while($nounou = mysqli_fetch_array($result)){

                    echo("<div class='container' >
                            <img class='float-right w-25' src=''../img/".$nounou['lien_photo']."' alt='image nounou'>
                            <div>
                                <h5>" . $nounou['prenom'] . " " . $nounou['nom'] . "</h5>
                                <ul>
                                    <li>Expérience : " . $nounou['annees_experience'] . " ans</li>
                                    <li>Age : " . $nounou['age'] . " ans</li>
                                    <li>Présentation : " . $nounou['presentation'] . "</li>
                                </ul>
                                <br><br><br><br>
                                <p class='lead'>Disponibilités : </p>");

                    echo("<table class='table'>
                                    <thead>
                                    <tr>
                                        <th scope='col'>Jour</th>
                                        <th scope='col'>Heure de début</th>
                                        <th scope='col'>Heure de Fin</th>
                                        <th scope='col'>Réservation</th>
                                        ");

                    $request = "SELECT  n.idNounou, d.heure_debut, d.heure_fin, d.jour 
                            FROM NOUNOU as n, DISPONIBILITES as d, UTILISATEURS as u1, UTILISATEURS as u2, LANGUES as l
                            WHERE u1.id_utilisateur = ".$_SESSION['id']." 
                            AND u2.id_utilisateur = n.idNounou 
                            AND u1.ville = u2.ville 
                            AND d.recurrence = 1 
                            AND l.langue = '". $_POST['langue'] ."'
                            AND l.idNounou = n.idNounou;";

                    $result = mysqli_query($bdd, $request);

                    while($nounou = mysqli_fetch_array($result)){
                        echo("<tr><td>" . $nounou['jour'] . "</td>");
                        echo("<td>" . $nounou['heure_debut'] . "</td>");
                        echo("<td>" . $nounou['heure_fin'] . "</td>");
                        echo("<td>

                                <form class='form' method='post' action='board_parent.php'>
                                    <input type='hidden' class='form-control' name='type' value='etrangere'>
                                    <input type='hidden' class='form-control' name='idParents' value='".$_SESSION['id']."' >
                                    <input type='hidden' class='form-control' name='idNounou' value='".$nounou['idNounou']."' >
                                    <input type='hidden' class='form-control' name='jour' value='".$nounou['jour']."' >
                                    <input type='hidden' class='form-control' name='heure_debut' value='".$nounou['heure_debut']."'>
                                    <input type='hidden' class='form-control' name='heure_fin' value='".$nounou['heure_fin']."'>
                                    <input type='submit' class='btn btn-primary'  value='Réserver'>
                                </form>
                              </td></tr>");
                    }
                    echo("</tbody>
                                    </table>");

                }
                echo("</div>
                                    </div>");

                    }

                }

            $_POST = array();



}


        ?>
    </div>



    <div id="garde-ponctuelle" class="hidden">

        <h2 class="lead">Demande de garde ponctuelle</h2>

        <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE PONCTUELLE -->

        <form method="post" action="board_parent.php">
            <div class="form-group">
                <label for="début">Je recherche une nounou le :</label><br>
                <input type="date" max="2020-31-31" min="2018-01-12" name="date" class="form-control"><br>
            </div>
            <div class="form-group row">


                <div class="form-group col-md-5 ">
                    <label for="jour">À partir de :</label><br>
                    <select name="heure_debut" class="form-control ">
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
                    <label for="horaire">Jusqu'à :</label>
                    <select name="heure_fin" class="form-control">
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
                        <option>23</option>
                        <option>24</option>
                        <option>00</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                    </select>
                </div>
            </div>
            <input type="submit" name="ponctu" class='btn btn-primary' value="Rechercher une nounou">

        </form>


    </div>


    <div id="garde-recurrente" class="hidden">

        <h2 class="lead">Demande de garde récurrente</h2>
        <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE RECURRENTE -->


        <form method="POST" action="board_parent.php">
            <fieldset class="form-group form-row">
                <label for="jour">Cochez le jour de la semaine où vous souhaitez garder vos enfants :</label>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios1" value="lundi">
                    <label class="form-check-label" for="gridRadios1">
                        Lundi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios2" value="mardi">
                    <label class="form-check-label" for="gridRadios2">
                        Mardi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios3" value="mercredi">
                    <label class="form-check-label" for="gridRadios3">
                        Mercredi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios4" value="jeudi">
                    <label class="form-check-label" for="gridRadios4">
                        Jeudi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios5" value="vendredi">
                    <label class="form-check-label" for="gridRadios5">
                        Vendredi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios6" value="samedi">
                    <label class="form-check-label" for="gridRadios6">
                        Samedi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jour" id="gridRadios7" value="dimanche">
                    <label class="form-check-label" for="gridRadios7">
                        Dimanche
                    </label>
                </div>
            </fieldset>

            <div class="form-row">
                <div class="form-group col-md-5 ">
                    <label for="heure_debut">À Partir de :</label>
                    <select name="heure_debut" class="form-control ">
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
                <div class="form-group col-md-5 ">
                    <label for="heure_debut">Jusqu'à :</label>
                    <select name="heure_fin" class="form-control">
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
                        <option>23</option>
                        <option>24</option>
                        <option>00</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                    </select>
                </div>
            </div>

            <input type="submit" name="recu" class='btn btn-primary' value="Rechercher une nounou">

        </form>
    </div>


    <div id="garde-etrangere" class="hidden">

        <h2 class="lead">Demande de garde en langue étrangère</h2>

        <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE ETRANGERE -->

        <form class='form ' method="post" action="board_parent.php">
            <div class="form-group">
                <select class='form-control' name="langue">
                    <?php
                    $requete = "SELECT DISTINCT langue FROM LANGUES;";
                    $resultat = mysqli_query($bdd, $requete);

                    if ($resultat) {
                        while ($languesnounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
                            $langueNounou = $languesnounous['langue'];
                            echo("<option value=$langueNounou>$langueNounou</option>\n");
                        }
                    }
                    ?>

                </select>
            </div>


            <input class='btn btn-primary' name='etranger' type="submit" value="Rechercher">
        </form>





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
