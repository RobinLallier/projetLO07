<?php

class biblioSQL{


    static function insertIntoTable($bdd, $table, $stringSQL){


        $request ="INSERT INTO ".$table." ".$stringSQL.";";



        /*if (mysqli_query($bdd, $request)) {
            echo "New record into $table created successfully";
        } else {
            echo "Error: " . $request . "<br>" . mysqli_error($bdd);
        }*/
    }


    static function findInTable($bdd, $table, $needle, $cle, $valeur){
        $request = "SELECT ".$needle." FROM ".$table." WHERE ".$cle."='".$valeur."';";

        $tuple = mysqli_query($bdd, $request);
       if($tuple){
            $result = mysqli_fetch_array($tuple, MYSQLI_ASSOC);
        }

        return $result[$needle];

    }
}
