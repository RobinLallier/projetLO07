<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 08/06/2018
 * Time: 16:49
 */

print_r($_POST);
echo('<br>');
//optionnel : ajouter les fonctions de filtrage/nettoyage sur tous les POST/GET !

$enfants = array (
    "nom" => $_POST['enfant'],
    "date_naissance" => $_POST['date_naissance'],
    "restrictions_alim" => $_POST['restrictions_alim']);

print_r($enfants);
echo("<br>");
echo("<br>");
$max = count($enfants);

for($i=0 ; $i < $max; $i++){
    echo($enfants["nom"][$i]);
    echo($enfants["date_naissance"][$i]);
    echo($enfants["restrictions_alim"][$i]);
}

echo("<br>");echo("<br>");echo("<br>");
foreach ($enfants as $key => $value) {

    echo($key."<br>");
    foreach($value as $one){
        echo ($one."<br>");
    }

}

