<?php

class biblioSQL{


    static function insertIntoTable($bdd, $table, $stringSQL){


        $request = "INSERT INTO ".$table." ".$stringSQL.";" ;

        if (mysqli_query($bdd, $request)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $request . "<br>" . mysqli_error($bdd);
        }
    }

}