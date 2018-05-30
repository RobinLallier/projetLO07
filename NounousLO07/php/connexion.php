<?php
include 'config.php';
session_start();

//Vérification de la validité des informations entrées
if( isset($_POST["login"]) && isset($_POST["password"])) {

    $login = $_POST["login"];
    printf($login);
    $password = $_POST["password"];
    printf($password);
    //Hachage du mot de passe
    //$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if( mysqli_query($bdd, "SELECT * FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\"; ")){

        if(mysqli_query($bdd, "SELECT admin FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\"; ") === "1") {
            $_SESSION['categorie']='admin';
            header(Location: )
            echo("<h1> Cette personne est un admin</h1>");
        }
        else{
            $user =  mysqli_query($bdd, "SELECT id_utilisateur FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\"; ");
            $result = mysqli_fetch_array($user, MYSQLI_ASSOC);


            if(mysqli_query($bdd, "SELECT * FROM NOUNOU WHERE idNounou=".$result["id_utilisateur"]." ; ")){
                $_SESSION['categorie']='nounou';
                echo("<h3>coucou! ".$_SESSION['categorie']."</h3>");
            }
            else{
                $_SESSION['categorie']='parent';
                echo("<h3>coucou! ".$_SESSION['categorie']."</h3>");
            }

        }
    }
    else{
        echo("<h2>Ces identifiants ne sont pas reconnus. Veuillez retourner au formulaire précédent.</h2>");
    }

}

?>