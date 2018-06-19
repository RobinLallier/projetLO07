<?php
include "php_class/Utilisateur.php";
include "config.php";
include "php_class/Nounou.php";
include "php_class/Parents.php";
include "php_class/Enfant.php";

print_r($_POST);

//Hachage du mot de passe
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$user = new Utilisateur($_POST["nom"], $_POST["prenom"], $_POST["ville"]
    , $_POST["email"], $_POST["telephone"], $_POST["login"], $password);

$user->addToDatabase($bdd);



echo("L'id utilisateur est le : ".$user->getIdUtilisateur());




//On Checke si l'inscription est celle d'une nounou ou d'un parent
   if(isset($_POST["nounou_experience"]) && ($_POST["nounou_experience"] !== "")) {

       $nounou = new Nounou($user->getIdUtilisateur(), $_POST['photo'], $_POST['age'], $_POST['nounou_experience'], $_POST['description']);
       $nounou->addToDatabase($bdd);


       header("Location : http://localhost:8888/index.html");
   }
    elseif(isset($_POST["informations"])){


        echo("<br><h2>On va au bon endroit</h2>");

       $parent = new Parents($user->getIdUtilisateur(), $_POST["informations"]);
       $parent->addToDatabase($bdd);

        $enfants = array (
        "nom" => $_POST['enfant'],
        "date_naissance" => $_POST['date_naissance'],
        "restrictions_alim" => $_POST['restrictions_alim']);

        $max = count($enfants);

        for($i=0 ; $i+1 < $max; $i++){
            $j= $i;
            $j = new Enfant($user->getIdUtilisateur(), $enfants["nom"][$i], $enfants["date_naissance"][$i], $enfants["restrictions_alim"][$i]);
            $j->addToDatabase($bdd);
        }

    }
    else{
       echo("<br><h2>On a un pb</h2>");
    }

echo("<br><h2>mauvaise structure</h2>");


?>
