<?php
include "php_class/Utilisateur.php";
include "config.php";
include "php_class/Nounou.php";
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

   }
    elseif(isset($_POST["informations"]) && ($_POST["informations"] !== "")){
       $parent = new Parent();

    }
  //header("Location : http://localhost:8888/index.html");



?>
