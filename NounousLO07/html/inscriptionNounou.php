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
    <a href="../index.html" >
        <img src="../img/rattle.png" class="float-left logo" alt="hochet">
    </a>
    <h1 class="titreaccueil">maNounou.com</h1>
    <h2 class="lead">Le meilleur site de recherche de nounous</h2>
</header>
<nav class="nav justify-content-end">
    <a href="../php/config.php" class="nav-item ">Se Connecter</a>

</nav>
<div class="row">
    <div class="jumbotron col-10 offset-md-1">
 <form method="post" action="../php/inscription.php">
     <fieldset>
         <legend>Veuillez rentrez les informations suivantes :</legend>
         <div class="form-group">
             <label for="login">Login</label>
             <input type="text" class="form-control" name="login" placeholder="Choisissez un login">

             <label for="password">Mot de Passe</label>
             <input type="password" class="form-control" name="password" placeholder="Votre mot de passe">
             <small id="emailHelp" class="form-text text-muted">Votre mot de passe restera confidentiel.</small>
         </div>
        <br>
        <br>
     <div class="form-group">
         <label for="nom">Nom</label>
         <input type="text" class="form-control" name="nom" placeholder="Votre nom">
         <label for="prenom">Prénom</label>
         <input type="text" class="form-control" name="prenom" placeholder="Votre prénom">

         <label for="ville">Code Postal</label>
         <input type="text" class="form-control" name="ville" placeholder="Votre code postal">


         <label for="email">Adresse eMail</label>
         <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Votre email">

         <label for="telephone">Numéro de téléphone</label>
         <input type="text" class="form-control" name="telephone" placeholder="Votre numéro de portable">

         <label for="age">Age</label>
         <input type="number" class="form-control" name="age" placeholder="">


         <label for="photo">Votre photo</label>
         <input type="file" class="form-control" name="photo" placeholder="">
     </div>
         <div class="form-group">
             <label for="nounou_experience">Années d'expérience</label>
             <input type="number" class="form-control" name="nounou_experience" placeholder="">
     <!--TODO Ajouter Langues Étrangères -->
         </div>

         <div class="form-group">
             <label for="description">Description</label>
             <input type="textarea" class="form-control" name="description" placeholder="">
         </div>

         <div class="form-check">
             <input type="checkbox" class="form-check-input" name="conditions" required>
             <label class="form-check-label" for="exampleCheck1">J'accepte les conditions générales d'utilisation</label>
         </div>
 <br>
         <button type="submit" class="btn btn-primary">M'inscrire</button>
     </fieldset>

 </form>
    </div>
</body>
</html>