<?php

class biblioSQL{


    static function insertIntoTable($bdd, $table, $stringSQL){


        $request ="INSERT INTO ".$table." ".$stringSQL.";";



        if (mysqli_query($bdd, $request)) {
            echo "New record into $table created successfully";
        } else {
            echo "Error: " . $request . "<br>" . mysqli_error($bdd);
        }
    }


    static function findInTable($bdd, $table, $needle, $cle, $valeur){
        $request = "SELECT ".$needle." INTO ".$table."WHERE ".$cle."=".$valeur.";";

        $result = mysqli_query($bdd, $request);
        

    }
}
