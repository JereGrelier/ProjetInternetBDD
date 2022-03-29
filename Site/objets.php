<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <meta charset="utf-8"/>
  <title>Liste des objets</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    <h2>Liste des objets</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr>
        <th>Nom</th>
        <th>Unique</th>
        <th>Bonus de puissance</th>
        <th>Actions</th>
          </tr>
        <?php
          $requete = "select * from OBJET order by OBJET.IdObjet asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $zones =  $res->fetchAll();
                //echo print_r($espece);
                foreach($zones as $zone) {
                echo '<td>'.$zone['NomObjet'].'</td>';
                echo '<td>'; ($zone['IsUnique'] == 1) ?  $a='✓' :  $a='X'; echo $a.'</td>';
                echo '<td>'.$zone['BonusPuissance'].'</td>';
                echo '<td><form method="post" action="./delete/deleteObjet.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><img class="delete" src="../assets/376.png" alt="" /><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="'.$zone['IdObjet'].'"/>
                      <input type="hidden" name="name" value="'.$zone['NomObjet'].'"/>
                    </form></td>';
                echo '</tr>'."\n";
                }
                /*liberation de l'objet requete:*/
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        ?>
      </table>
      <button onclick="document.getElementById('mydialog').style.visibility = 'visible'">Ajouter un type</button>
   </div>
   <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter un Proprietaire</h1>
      <form action="./add-objet.php" method="post">
        <label>Nom : <input type="text" id="Name" name="Name" required><br></label>
        <label>Bonus de puissance : <input type="number" id="Bonus" name="Bonus" min="0" max="3" step="0.1" required><br></label>
        <label>Unique? <input type="checkbox" id="Unique" name="Unique"></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="/Site/assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
