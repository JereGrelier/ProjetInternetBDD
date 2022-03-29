<?php 
        include 'connect.php';
        echo '<option value="null">'.(intval($_POST['Species'])).'</option>';
        $sql = 'select * from MOVESET_ESPECE, ATTAQUE where NumEspece = '.$a. ' and MOVESET_ESPECE.IdAttaque = ATTAQUE.IdAttaque';
        $res = $dbh->query($sql);
        if($res)
        {
            /* ... on récupère un tableau stockant le résultat */
                $choices = $res->fetchAll();
                print_r($a);
                foreach($choices as $choice) {
                echo '<option value="'.$choice['IdAttaque'].'">'.$choice['NomAttaque'].'</option>';
                }
                /*liberation de l'objet requete:*/
            //$choices->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        }
    ?>