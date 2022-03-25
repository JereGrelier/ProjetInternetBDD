<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <meta charset="utf-8"/>
  <title>Liste des Monstropoches</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    <h2>Liste des Monstropoches</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr>
        <th>Surnom</th>
        <th>Etat</th>
        <th>PV</th>
        <th>PE</th>
        <th>Genre</th>
        <th>N°espèce</th>
        <th>Objet</th>
        <th>Propriétaire</th>
        <th colespan="2">Actions</th>
          </tr>
        <?php
          $requete = "select * from MONSTROPOCHE order by MONSTROPOCHE.IdMonstropoche asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $monstropoches =  $res->fetchAll();
                //echo print_r($espece);
                foreach($monstropoches as $monstropoche) {
                echo '<td>'.$monstropoche['Surnom'].'</td>';
                echo '<td><form method="post" action="edit.php">
                      <input type="submit" name="action" value="Editer"/>
                      <input type="hidden" name="id" value="'.$monstropoche['IdType'].'"/>
                    </form></td>';
                echo '<td><form method="post" action="delete.php">
                      <input type="submit" name="action" value="Supprimer"/>
                      <input type="hidden" name="id" value="'.$monstropoche['IdType'].'"/>
                      <input type="hidden" name="table" value="TYPE"/>
                      <input type="hidden" name="tableId" value="IdType"/>
                    </form></td>';
                echo '</tr>'."\n";
                }
                /*liberation de l'objet requete:*/
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
        ?>
      </table>
      <button onclick="document.getElementById('mydialog').style.visibility = 'visible'">Ajouter un Monstropoches</button>
   </div>
   <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter un Monstropoches</h1>
      <form action="./add-monstropoche.php" method="post">
        <label>Surnom : <input type="text" id="nickname" name="nickname" required><br></label>
        <label>PV : <input type="number" id="HP" name="HP" required><br></label>
        <label>Genre : <select name="Gender" id="Gender">
        <option value="">--Choisissez--</option>
        <option value="Male">Mâle</option>
        <option value="Femelle">Femelle</option>
        <option value="Femelle">Binaire</option>
        <option value="Femelle">Non binaire</option>
        </label>
        <label>Espèce : <select name="Species" id="Species">
        <option value="">--Choisissez--</option>
        <?php include "searchEspece.php" ?>
        </select> <br></label>
        <label>Objet : <select name="Object" id="Object">
        <option value="">--Choisissez--</option>
        <?php include "searchObjet.php" ?>
        </select> <br></label>
        <label>Propriétaire : <select name="Owner" id="Owner">
        <option value="">--Choisissez--</option>
        <?php include "searchProprietaire.php" ?>
        </select> <br></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
