<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 30/05/2018
 * Time: 11:27
 */
//Vérification de la validité des informations entrées
if( isset($_POST["email"]) && isset($_POST["password"])){

    //Hachage du mot de passe
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);




}

