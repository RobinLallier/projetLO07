<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MaNounou.com</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="container-fluid">
<header class="text-center container-fluid">
    <a href="index.html" >
        <img src="../img/rattle.png" class="float-left logo" alt="hochet">
    </a>
    <h1 class="titreaccueil">maNounou.com</h1>
    <h2 class="lead">Le meilleur site de recherche de nounous</h2>
</header>
 <form method="GET" action="board_nounou.html">
     <p>
     <fieldset>
         <legend>Veuillez rentrez les informations suivantes</legend>
         <br>
         Nom :
         &nbsp;
         <input type="text" name="nom" value=""/>
         <br><br>
         Prénom :
         &nbsp;
         <input type="text" name="prenom" value=""/>
         <br><br>
         Ville :
         &nbsp;
         <input type="text" name="ville" value="Entrez le code postal"/>
         <br><br>
         Adresse e-mail :
         &nbsp;
         <input type="text" name="mail" value=""/>
         <br><br>
         Numéro de téléphone :
         &nbsp;
         <input type="text" name="ville" value=""/>
         <br><br>
         Age :
         &nbsp;
         <input type="number" name="age" value="0">
         <br><br>
         Veuillez charger votre photo :
         &nbsp;
         <input type="file" name="photo">
         <br><br>
         Années d'expérience :
         &nbsp;
         <input type="number" name="experience" value="0">
         <br><br>
         Description:
         &nbsp;
         <textarea name="description">Expérience en tant que nounou</textarea>
         <br><br>
         <input type="submit" name="envoi" value="S'inscrire">

     </fieldset>
 </form>
</body>
</html>