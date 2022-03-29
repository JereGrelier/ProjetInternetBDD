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
        <th>Espèce</th>
        <th>Attaque</th>
        <th>Objet</th>
        <th>Propriétaire</th>
        <th>Actions</th>
          </tr>
        <?php
          $requete = "select * from MONSTROPOCHE, MOVESET_MONSTROPOCHE, OBJET, ATTAQUE, ESPECE, PROPRIETAIRE where MONSTROPOCHE.IdMonstropoche = MOVESET_MONSTROPOCHE.IdMonstropoche AND MOVESET_MONSTROPOCHE.IdAttaque = ATTAQUE.IdAttaque AND
          MONSTROPOCHE.NumEspece = ESPECE.Numero AND MONSTROPOCHE.IdProprietaire = PROPRIETAIRE.IdProprietaire AND MONSTROPOCHE.IdObjet = OBJET.IdObjet order by MONSTROPOCHE.IdMonstropoche asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $monstropoches =  $res->fetchAll();
                //echo print_r($espece);
                foreach($monstropoches as $monstropoche) {
                echo '<td>'.$monstropoche['Surnom'].'</td>';
                echo '<td>'.$monstropoche['Etat'].'</td>';
                echo '<td>'.$monstropoche['PV'].'</td>';
                echo '<td>'.$monstropoche['PE'].'</td>';
                echo '<td>'.$monstropoche['Genre'].'</td>';
                echo '<td>'.$monstropoche['NomEspece'].'</td>';
                echo '<td>'.$monstropoche['NomAttaque'].'</td>';
                echo '<td>'.$monstropoche['NomObjet'].'</td>';
                echo '<td>'.$monstropoche['NomProprietaire'].'</td>';
                echo '<td><form method="post" action="delete.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="'.$monstropoche['IdMonstropoche'].'"/>
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
        <label>Surnom : <input type="text" id="Nickname" name="Nickname" required><br></label>
        <label>PV : <input type="number" id="HP" name="HP" min=1 max="100" required><br></label>
        <label>Genre : <select name="Gender" id="Gender">
        <option value="">--Choisissez--</option>
        <option value="Male">Mâle</option>
        <option value="Femelle">Femelle</option>
        <option value="Femelle">Binaire</option>
        <option value="Femelle">Non binaire</option>
        </select> <br> </label>
        <label>Espèce : <select name="Species" id="Species">
        <option value="">--Choisissez--</option>
        <?php include "searchEspece.php" ?>
        </select> <br></label>
        <label>Attaque : <select name="Attack" id="Attack">
        <option value="">--Choisissez--</option>
        <?php include "searchAttaque.php" ?>
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
