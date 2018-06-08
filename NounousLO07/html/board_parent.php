<?php
session_start();
//On vérifie que la session correspond bien à un parent, sinon on déconnecte l'utilisateur.
if($_SESSION['categorie'] !== 'parent'){
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
        <nav class="navbar navbar-expand-lg navbar-light">
            <span class="navbar-brand">Tableau de Bord</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ">
                <div class="navbar-nav">
                    <p class="nav-item mr-2"><button type="button" id="nounou" class="btn btn-outline-info" onclick=affiche("garde-ponctuelle") >Garde Ponctuelle</button></p>
                    <p class="nav-item mr-2"><button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("garde-recurrente") >Garde Récurrente</button></p>
                    <p class="nav-item mr-2"><button type="button" id="ca" class="btn btn-outline-info" onclick=affiche("garde-etrangere") >Garde Étrangère</button></p>
                </div>
            </div>

        </nav>
        <hr class="my-4">



        <div id="garde-ponctuelle" class="hidden">

            <h2 class="lead">Demande de garde ponctuelle</h2>

            <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE PONCTUELLE -->
            <form class="form container" method="post">
                <fieldset class="form-group col-md-5">
                    <label for="date">Choisissez la date de la garde :</label>
                    <input class="form-control" type="date" name="date" min="2018-06-01" max="2018-12-31">
                </fieldset>
                <div class="form-row">
                    <div class="form-group col-md-5 ">
                        <label for="heure-debut">Entrez l'heure de début :</label>
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
                        <label for="heure-fin" class="">Entrez l'heure de fin :</label>
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
                <button type="submit" class="btn btn-primary">Trouver une nounou!</button>
            </form>

        </div>


        <div id="garde-recurrente" class="hidden">

            <h2 class="lead">Demande de garde récurrente</h2>
            <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE RECURRENTE -->
        </div>


        <div id="garde-etrangere" class="hidden">

            <h2 class="lead">Demande de garde en langue étrangère</h2>

            <!-- INSERER FORMULAIRE DE DEMANDE DE GARDE ETRANGERE -->

            <form method="post" action="board_parent.php">
                <select name="langueNounou">
                    <?php
                    $requete = "SELECT DISTINCT langue FROM LANGUES;";
                    $resultat = mysqli_query($bdd, $requete);

                    if ($resultat) {
                        while ($languesnounous = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
                            $langueNounou = $languesnounous['langue'];
                            echo ("<option value=$langueNounou>$langueNounou</option>\n");
                        }
                    }
                    ?>

                </select>

                <input type="submit" value="Rechercher">
            </form>







            <?php

            if(isset($_POST['langueNounou'])){
                $langueNounou = $_POST['langueNounou'];


                $requete = "SELECT u.nom, u.prenom, n.age, n.annees_experience, n.presentation FROM LANGUES l, NOUNOU n, UTILISATEURS u WHERE l.langue=\"$langueNounou\" AND u.id_utilisateur=n.idNounou AND n.idNounou=l.idNounou;";
                $resultat = mysqli_query($bdd, $requete);





            if ($resultat) {
                echo("<table class=\"table\">
                <thead>
                <tr>
                    <th scope=\"col\">Nom</th>
                    <th scope=\"col\">Prénom</th>
                    <th scope=\"col\">Age</th>
                    <th scope=\"col\">Années d'expérience</th>
                    <th scope=\"col\">Présentation</th>

                </tr>
                </thead>
                <tbody>");

                while ($listenounouslangue = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
                    $nom = $listenounouslangue['nom'];
                    $prenom = $listenounouslangue['prenom'];
                    $age = $listenounouslangue['age'];
                    $experience = $listenounouslangue['annees_experience'];
                    $presentation = $listenounouslangue['presentation'];

                    echo("<tr><td>" . $nom . "</td>");
                    echo("<td>" . $prenom . "</td>");
                    echo("<td>" . $age . "</td>");
                    echo("<td>" . $experience . "</td>");
                    echo("<td>" . $presentation . "</td></tr>");

                }
            }



                }

            ?>

                </tbody>
            </table>
        </div>

    </div>

    <script src="../js/affiche.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
