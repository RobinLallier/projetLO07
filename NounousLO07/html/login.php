<?php
 include '../php/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MaNounou.com</title>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="container-fluid">
<header class="text-center container-fluid">
    <a href="../index.html" >
        <img src="../img/rattle.png" class="float-left logo" alt="hochet">
    </a>
    <h1>maNounou.com</h1>
    <h2 class="lead">Le meilleur site de recherche de nounous</h2>
</header>
<nav class="nav justify-content-end">
    <a href="../php/config.php" class="nav-item ">Se Connecter</a>

</nav>
<div class="row">
    <div class="jumbotron col-10 offset-md-1">
        <form method="post" action="../php/connexion.php">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" placeholder="Votre login">

            </div>
            <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input type="password" class="form-control" name="password" placeholder="Votre mot de passe">
                <small id="emailHelp" class="form-text text-muted">Votre mot de passe restera confidentiel.</small>
            </div>

            <button type="submit" class="btn btn-primary">Me Connecter</button>
        </form>
    </div>
</div>



</body>
</html>