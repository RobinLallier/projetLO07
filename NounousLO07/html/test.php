<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 08/06/2018
 * Time: 16:49
 */

print_r($_POST);

$enfants = $_POST['enfant']; //optionnel : ajouter les fonctions de filtrage/nettoyage sur tous les POST/GET !
$date_naissance = $_POST['date_naissance'];

foreach ($enfants as $key => $value) {
    echo "Clé : $key; Valeur : $value<br />\n";
}

