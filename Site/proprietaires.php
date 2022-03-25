<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <meta charset="utf-8"/>
  <title>Liste des proprietaires</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    <h2>Liste des proprietaires</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr>
        <th>Nom</th>
        <th>Jouable</th>
        <th colspan="2">Actions</th>
          </tr>
        <?php
          $requete = "select * from PROPRIETAIRE order by PROPRIETAIRE.IdProprietaire asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $zones =  $res->fetchAll();
                //echo print_r($espece);
                foreach($zones as $zone) {
                echo '<td>'.$zone['NomProprietaire'].'</td>';
                echo '<td>'.$zone['IsJouable'].'</td>';
                echo '<td><form method="post" action="edit.php">
                      <input type="submit" name="action" value="Editer"/>
                      <input type="hidden" name="id" value="'.$zone['IdProprietaire'].'"/>
                    </form></td>';
                echo '<td><form method="post" action="./delete/deleteType.php">
                      <input type="submit" name="action" value="Supprimer"/>
                      <input type="hidden" name="id" value="'.$zone['IdProprietaire'].'"/>
                      <input type="hidden" name="name" value="'.$zone['NomProprietaire'].'"/>
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
      <form action="./add-proprietaire.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <label>Jouable? <input type="checkbox" id="Jouable" name="Jouable"></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
