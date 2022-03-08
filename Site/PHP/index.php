<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <meta charset="utf-8"/>
  <title>Liste des espèces</title>
 </head>
 <body>
 <div class="topnav" id="topnav">
        <a href="/">Liste des espèces</a>
    </div>
   <h2>Liste des espèces de monstropochetrons</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
     <table>
       <tr>
     <th>Numero</th>
     <th>Nom</th>
     <th>Type</th>
     <th>Evolution</th>
     <th>Zone</th>
       </tr>
<?php
      $requete = "select * from ESPECE, TYPE, ZONE where ESPECE.type = TYPE.idType and ESPECE.zone = ZONE.idZone order by ESPECE.numero asc";
      /* Si l'execution est reussie... */
      if($res = $dbh->query($requete))
          /* ... on récupère un tableau stockant le résultat */
            $espece =  $res->fetchAll();
            //echo print_r($espece);
            foreach($espece as $esp) {
            echo "\t".'<tr><td>'.$esp['numero'].'</td>';
            echo '<td>'.$esp['nomEspece'].'</td>';
            echo '<td>'.$esp['nomType'].'</td>';
            echo '<td>'.$esp['evolution'].'</td>';
            echo '<td>'.$esp['nomZone'].'</td>';
            echo '</tr>'."\n";
            }
            /*liberation de l'objet requete:*/
         $res->closeCursor();
         /*fermeture de la connexion avec la base*/
         $dbh = null;
?>
   </table>
   <div role="dialog" aria-modal="true" aria-labelledby="modal-heading">
  <!-- <button>Fermer</button> -->
  <h1 id="modal-heading">Ajouter une espèce de monstropochetrons</h1>
  <form action="add-espece.php" method="post">
    <label>Numéro : <input type="number" id="number" name="number"><br></label>
    <label>Nom : <input type="text" id="name" name="name" required><br></label>
    <label>Type : <select name="type" id="type">
    <option value="">--Choisissez--</option>
    <?php include "searchType.php" ?>
    </select><br> </label>
    <label>Zone : <select name="zone" id="zone">
    <option value="">--Choisissez--</option>
    <?php include "searchZone.php" ?>
    </select> <br></label>
    <input type="submit" value="valider">
  </form>
</div>
 </body>
</html>
