# projetLO07

## TODO List

###TicketsList
    Header redirect sur l'accès involontaire vers une page interdite (board-admin.php)
    
   
    -Insérer Parent
    -Insérer Enfants
    -Insérer Recommandation
    
    

### Requêtes SQL à faire
-Chiffre d'affaire du site sur une période
Le salaire des nounous est de 7 € par heure commencée pour un enfant et avec 4 € supplémentaires par heure
pour chaque enfant supplémentaire :
● 3h15 avec un enfant = 4h * 7 = 28 €
● 2h avec 3 enfant = 2 * (7 + 4 + 4) = 30 €

-Afficher toutes les disponibilités associées à une nounou.

-Afficher les nounous disponibles en fonction d'un jour, d'une heure de début et d'une heure de fin et d'un code postal (potentiellement récurrent)
-Afficher la liste des langues étrangères indiquées par les nounous


### BDD SQL
-Modifier la table disponibilité:
    -Heure-début et heure-fin doivent être en INT (bcp plus simple à gérer)
    -recurrence par défault à 0
    -date par défault à NULL
    -Jour par défault à NULL aussi (pas besoin de mettre de jour si c'est pas récurrent en fait)


