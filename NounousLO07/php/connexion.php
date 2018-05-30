<ul>
<?php
include 'config.php';

if(isset($_POST["login"]) && ($_POST["login"] != "")) printf("<li><b>login</b> = %s</li>", $_POST["login"]);
else(printf("<li><h2>PAS DE LOGIN FOURNI</h2></li>"));
if(isset($_POST["password"]) && ($_POST["password"] != "")) printf("<li><b>mot de passe</b> = %s</li>", $_POST["password"]);
else(printf("<li><h2>PAS DE mot de passe FOURNI</h2></li>"));
?>
</ul>
<?php
//Vérification de la validité des informations entrées
if( isset($_POST["login"]) && isset($_POST["password"])) {
    printf("<h2>rentré dans la boucle</h2>");
    $login = $_POST["login"];
    printf($login);
    $password = $_POST["password"];
    printf($password);
    //Hachage du mot de passe
    //$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if( mysqli_query($bdd, "SELECT * FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\"; ")){
        printf("rentré ici");
        if(mysqli_query($bdd, "SELECT admin FROM UTILISATEURS WHERE mdp=\"$password\" AND login=\"$login\"; ") === "1") {
            echo("<h1> Cette personne est un admin</h1>");
        }
        else{
            echo("<h1>Cette personne n'est pas un admin</h1>");
        }
    }





}

?>