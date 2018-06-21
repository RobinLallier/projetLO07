<?php

include "config.php";
include "php_class/Utilisateur.php";
include "php_class/Nounou.php";
include "php_class/Langue.php";
include "php_class/Parent.php";
include "php_class/Enfant.php";

//Hachage du mot de passe
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);


$user = new Utilisateur($_POST["nom"], $_POST["prenom"], $_POST["ville"]
    , $_POST["email"], $_POST["telephone"], $_POST["login"], $password);

$user->addToDatabase($bdd);


//On Checke si l'inscription est celle d'une nounou ou d'un parent
if (isset($_POST["nounou_experience"]) && ($_POST["nounou_experience"] !== "")) {

    $nounou = new Nounou($user->getIdUtilisateur(), $_POST['photo'], $_POST['age'], $_POST['nounou_experience'], $_POST['description']);
    $nounou->addToDatabase($bdd);

    $langues = $_POST['langue'];
    foreach($langues as $langue){
        $j = new Langue($user->getIdUtilisateur(), $langue);
        $j->addToDatabase($bdd);
    }

    header("Location: http://localhost:8888/index.html");
} //On vérifie si l'utilisateur est un parent
elseif (isset($_POST["informations"])) {


    $parent = new Parents($user->getIdUtilisateur(), $_POST["informations"]);
    $parent->addToDatabase($bdd);

    $enfants = array(
        "nom" => $_POST['enfant'],
        "date_naissance" => $_POST['date_naissance'],
        "restrictions_alim" => $_POST['restrictions_alim']);

    $max = count($enfants);

    for ($i = 0; $i + 1 < $max; $i++) {
        $j = $i;
        $j = new Enfant($user->getIdUtilisateur(), $enfants["nom"][$i], $enfants["date_naissance"][$i], $enfants["restrictions_alim"][$i]);
        $j->addToDatabase($bdd);
    }

} else {
    echo("<h2>Votre formulaire a été mal rempli. Veuillez recommencer SVP.</h2>");
}


?>
