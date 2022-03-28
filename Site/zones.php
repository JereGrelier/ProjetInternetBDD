<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <meta charset="utf-8"/>
  <title>Liste des Zones</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    <h2>Liste des zones</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr>
        <th>Nom</th>
        <th>Actions</th>
          </tr>
        <?php
          $requete = "select * from ZONE order by ZONE.IdZone asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $zones =  $res->fetchAll();
                //echo print_r($espece);
                foreach($zones as $zone) {
                echo '<td>'.$zone['NomZone'].'</td>';
                echo '<td><form method="post" action="deleteZone.php">
                <button type="submit" name="btnEnvoiForm" title="Envoyer"><img class="delete" src="../assets/376.png" alt="" /><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="'.$zone['IdZone'].'"/>
                      <input type="hidden" name="name" value="'.$zone['NomZone'].'"/>
                    </form></td>';
                echo '</tr>'."\n";
                }
                /*liberation de l'objet requete:*/
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        ?>
      </table>
      <button onclick="document.getElementById('mydialog').style.visibility = 'visible'">Ajouter une espèce</button>
   </div>
   <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une Zone</h1>
      <form action="./add-zone.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
