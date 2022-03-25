<?php 
        include 'connect.php';
        $sql = 'select * from OBJET';
        $res = $dbh->query($sql);
        if($res)
        {
            /* ... on récupère un tableau stockant le résultat */
                $choices = $res->fetchAll();
                foreach($choices as $choice) {
                echo '<option value="'.$choice['IdObjet'].'">'.$choice['NomObjet'].'</option>';
                }
                /*liberation de l'objet requete:*/
            //$choices->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        }
    ?>