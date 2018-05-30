<?php
include "php_class/Nounou.php";
include "php_class/Parents.php";

//Hachage du mot de passe
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

//On Checke si l'inscription est celle d'une nounou ou d'un parent
    if(isset($_POST["nounou_experience"]) && ($_POST["nounou_experience"] !== "")){

        $nounou = new Nounou($_POST['nom'], $_POST['prenom'], $_POST['ville'],$_POST['email'], $_POST['numero'], $_POST['photo'], $_POST['age'], $_POST['nounou_experience'], $_POST['description']);
        $nounou->addToDatabase()




    }



