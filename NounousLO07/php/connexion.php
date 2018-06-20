<?php
include 'config.php';
session_start();

print_r($_POST);
//Vérification de la validité des informations entrées
if( isset($_POST["login"]) && isset($_POST["password"])) {

    $login = $_POST["login"];

    //Vérification du mot de passe
    $password = $_POST["password"];
    $result1 = mysqli_query($bdd, "SELECT * FROM UTILISATEURS WHERE login='$login'; ");

    $resultat = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $isPasswordCorrect = password_verify($password, $resultat['mdp']);

    if( mysqli_num_rows($result1) === 1 && $isPasswordCorrect){

        if($resultat['admin'] === '1') {
            session_start();
            $_SESSION['categorie']='admin';
            $_SESSION['nom']=$_POST["login"];
            header("Location: http://localhost:8888/html/board_admin.php");
        }
        else{

            //Associe un id à la session de l'utilisateur
            $_SESSION['id'] = $resultat["id_utilisateur"];

            $request = mysqli_query($bdd, "SELECT * FROM NOUNOU WHERE idNounou=".$resultat["id_utilisateur"]." ; ");
            if(mysqli_num_rows($request)===1){
                $_SESSION['categorie']='nounou';
                header("Location: http://localhost:8888/html/board_nounou.php");
            }
            else{
                $_SESSION['categorie']='parent';
                $_SESSION['ville']= $resultat['ville'];
                header("Location: http://localhost:8888/html/board_parent.php");
            }

        }
    }
    else{
        echo("<h2>Ces identifiants ne sont pas reconnus. Veuillez retourner au formulaire précédent.</h2>");
    }

}

?>