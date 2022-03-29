<?php 
        echo "<script>
        var javascriptVar = document.getElementById('Species').value;
        </script>";
        $test = "<script>document.writeln(javascriptVar);</script>";
        include 'connect.php';  

        echo '<option value="null">'.$test.'</option>';
        $sql = 'select * from MOVESET_ESPECE, ATTAQUE where NumEspece = '.intval($test). ' and MOVESET_ESPECE.IdAttaque = ATTAQUE.IdAttaque';
        $res = $dbh->query($sql);
        print_r($res);
        if($res)
        {
            /* ... on récupère un tableau stockant le résultat */
                $choices = $res->fetchAll();
                print_r($a);
                foreach($choices as $choice) {
                echo '<option value="'.$choice['IdAttaque'].'">'.$choice['NomAttaque'].'</option>';
                }
                /*liberation de l'objet requete:*/
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        }
    ?>