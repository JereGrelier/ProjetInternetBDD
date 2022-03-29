<script>
function getdata(){
      var txtOne = document.getElementById('Species').value;
      document.cookie = "myJavascriptVar = " + txtOne </script>
}
</script>
<?php 
        $test= $_COOKIE['myJavascriptVar'];
        include 'connect.php';
        echo '<option value="null">'.(intval($_POST['test'])).'</option>';
        $sql = 'select * from MOVESET_ESPECE, ATTAQUE where NumEspece = '.$test. ' and MOVESET_ESPECE.IdAttaque = ATTAQUE.IdAttaque';
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
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        }
    ?>