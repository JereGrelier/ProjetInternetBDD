<?php 
        include '../connect.php';
        $sql = 'select * from TYPE';

        echo 'Allhuile ?';
        $res = $dbh->query($sql);
        if($res)
        {
            /* ... on récupère un tableau stockant le résultat */
                $choices = $res->fetchAll();
                echo 'Allo ?';
                foreach($choices as $choice) {
                echo '<option value="'.$choice['IdType'].'">'.$choice['NomType'].'</option>';
                }
                /*liberation de l'objet requete:*/
                print_r($choices);
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        }
    ?>