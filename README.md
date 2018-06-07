# projetLO07

## TODO List

###TicketsList
    Header redirect sur l'accès involontaire vers une page interdite (board-admin.php)
    
    -Disponibilité récurrente : mettre en place un système pour afficher chaque jour.
    -Disponibilité : insérer les disponibilités dans la bdd
    -Insérer Parent
    -Insérer Enfants
    -Insérer Recommandation
    
    

### Requêtes SQL à faire
-Chiffre d'affaire du site sur une période
Le salaire des nounous est de 7 € par heure commencée pour un enfant et avec 4 € supplémentaires par heure
pour chaque enfant supplémentaire :
● 3h15 avec un enfant = 4h * 7 = 28 €
● 2h avec 3 enfant = 2 * (7 + 4 + 4) = 30 €

#Il faut que le trigger fonctionne
#Pour le chiffre d'affaire il faudra marquer :

<?php
$chiffreaffaire ="SELECT SUM(revenus) FROM NOUNOU;";
$resultat = mysqli_query($bdd, $chiffreaffaire);

if($resultat){
	echo("Votre chiffre d'affaire s'élève à : " .$chiffreaffaire. "€.");
}
?>


-Afficher toutes les disponibilités associées à une nounou. 
--> Cliquer sur voir disponibilités 
#Je sèche (associer un tel bouton à la nounou de la ligne)


-Afficher les nounous disponibles en fonction d'un jour, d'une heure de début et d'une heure de fin et d'un code postal (potentiellement récurrent )
#Pour l'instant j'ai fait le formulaire garde ponctuelle (de tel jour à telle heure... dans telle ville)



### BDD SQL



