<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <script src="js/nav.js"></script> 
 <meta charset="utf-8"/>
  <title>Liste des espèces</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    <h2>Liste des espèces de monstropochetrons</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr class="headerListEspece">
        <th>Numero</th>
        <th>Nom</th>
        <th>Type</th>
        <!-- <th>Evolution</th> -->
        <th>Zone</th>
        <th>Image</th>
        <th id="right" colspan="2">Actions</th>
          </tr>
        <?php
          $requete = "select * from ESPECE, TYPE, HABITAT, ZONE where ESPECE.TypeEspece = TYPE.idType and ESPECE.Numero = HABITAT.NumEspece and HABITAT.IdZone = ZONE.IdZone order by ESPECE.numero asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $espece =  $res->fetchAll();
                //echo print_r($espece);
                foreach($espece as $esp) {
                echo "\t".'<tr><td>'.$esp['Numero'].'</td>';
                echo '<td>'.$esp['NomEspece'].'</td>';
                echo '<td>'.$esp['NomType'].'</td>';
                //echo '<td>'.$esp['evolution'].'</td>';
                echo '<td>'.$esp['NomZone'].'</td>';
                echo '<td> <img src="'.$esp['Sprite'].'"/></td>';
                echo '<td><form method="post" action="edit.php">
                      <input type="submit" name="action" value="Editer"/>
                      <input type="hidden" name="id" value="'.$esp['Numero'].'"/>
                    </form></td>';
                echo '<td><form method="post" action="./delete/deleteEspece.php">
                      <input type="submit" name="action" value="Supprimer"/>
                      <input type="hidden" name="id" value="'.$esp['Numero'].'"/>
                      <input type="hidden" name="name" value="'.$esp['NomEspece'].'"/>
                    </form></td>';
                }
                /*liberation de l'objet requete:*/
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        ?>
      <td id='sprite'></td>
      </table>
      <button onclick="document.getElementById('mydialog').style.visibility = 'visible'">Ajouter une espèce</button>
   </div>
   <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une Espèce</h1>
      <form action="./add-espece.php" method="post">
        <label>Numéro : <input type="number" id="number" name="number" min=1><br></label>
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
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
