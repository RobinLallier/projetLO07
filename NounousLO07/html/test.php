<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 08/06/2018
 * Time: 16:49
 */

print_r($_POST);

 for($i===0 ; $i < count($_POST['enfant']); $i++){

     echo("<p>Enfant n°".($i+1)." :</p>".
            "<h3>Nom : ".$_POST["enfant"][$i]."</h3>".
            "<h3>Date de naissance : ".$_POST["date_naissance"][$i]."</h3>");
}