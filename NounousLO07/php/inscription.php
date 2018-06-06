<?php
include "php_class/Utilisateur.php";
include "config.php";


echo("<h1>On est là</h1>");
//Hachage du mot de passe
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$user = new Utilisateur($_POST["nom"], $_POST["prenom"], $_POST["ville"]
    , $_POST["email"], $_POST["telephone"], $_POST["login"], $password);

echo("<ul>
<li>nom ".$user->getNom()."</li>
<li>prenom ".$user->getPrenom()."</li>
<li>ville ".$user->getVille()."</li>
<li>email ".$user->getEmail()."</li>
<li>tel ".$user->getTelephone()."</li>
<li>login ".$user->getLogin()."</li>
<li>mdp ".$user->getMdp()."</li>

</ul>");

echo("INSERT INTO UTILISATEURS ".$user->toSQLString().";");
$user->addToDatabase($bdd);
echo("<h2>c'est censé avoir marché</h2>");


//On Checke si l'inscription est celle d'une nounou ou d'un parent
  /*  if(isset($_POST["nounou_experience"]) && ($_POST["nounou_experience"] !== "")){

        $nounou = new Nounou($_POST['nom'], $_POST['prenom'], $_POST['ville'],$_POST['email'], $_POST['numero'], $_POST['photo'], $_POST['age'], $_POST['nounou_experience'], $_POST['description']);



*/
  header("Location : http://localhost:8888/index.html");



?>
