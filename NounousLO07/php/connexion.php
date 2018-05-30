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

        $req = mysqli_query($bdd, "SELECT admin FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\" AND admin=\"1\"; ");

        if(mysqli_num_rows($req) === 1) {
            $_SESSION['categorie']='admin';
            header("Location: http://localhost:8888/html/board_admin.html");
        }
        else{
            $user =  mysqli_query($bdd, "SELECT id_utilisateur FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\"; ");
            $result = mysqli_fetch_array($user, MYSQLI_ASSOC);

            $request = mysqli_query($bdd, "SELECT * FROM NOUNOU WHERE idNounou=".$result["id_utilisateur"]." ; ");
            if(mysqli_num_rows($request)===1){
                $_SESSION['categorie']='nounou';
                header("Location: http://localhost:8888/html/board_nounou.php");
            }
            else{
                $_SESSION['categorie']='parent';
                header("Location: http://localhost:8888/html/board_parent.php");
            }

        }
    }
    else{
        echo("<h2>Ces identifiants ne sont pas reconnus. Veuillez retourner au formulaire précédent.</h2>");
    }

}

?>