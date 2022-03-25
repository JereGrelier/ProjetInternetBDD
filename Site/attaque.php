<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <meta charset="utf-8"/>
  <title>Liste des Attaques</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
        <h2>Liste des Attaques</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr>
        <th>Nom</th>
        <th>Type</th>
        <th>Puissance</th>
        <th>Précision</th>
        <th colspan="2">Actions</th>
          </tr>
        <?php
          $requete = "select * from ATTAQUE, TYPE where ATTAQUE.TypeAttaque = TYPE.idType order by ATTAQUE.nomAttaque asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $attaques =  $res->fetchAll();
                //echo print_r($espece);
                foreach($attaques as $att) {
                echo '<td>'.$att['NomAttaque'].'</td>';
                echo '<td>'.$att['NomType'].'</td>';
                echo '<td>'.$att['Puissance'].'</td>';
                echo '<td>'.$att['Precision'].'</td>';
                echo '<td><form method="post" action="edit.php">
                      <input type="submit" name="action" value="Editer"/>
                      <input type="hidden" name="id" value="'.$att['IdAttaque'].'"/>
                    </form></td>';
                echo '<td><form method="post" action="delete.php">
                      <input type="submit" name="action" value="Supprimer"/>
                      <input type="hidden" name="id" value="'.$att['IdAttaque'].'"/>
                      <input type="hidden" name="table" value="ATTAQUE"/>
                      <input type="hidden" name="tableId" value="IdAttaque"/>
                    </form></td>';
                echo '</tr>'."\n";
                }
                        /*liberation de l'objet requete:*/
                        $res->closeCursor();
                        /*fermeture de la connexion avec la base*/
                        $dbh = null;
        ?>
      </table>
      <button onclick="document.getElementById('mydialog').style.visibility='visible'">Ajouter une attaque</button>
   </div>
    <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une attaque</h1>
      <form action="./add-attaque.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <label>Type : <select name="type" id="type">
        <option value="">--Choisissez--</option>
        <?php include "searchType.php" ?>
        </select><br> </label>
        <label>Puissance : <input type="number" id="power" name="power" min=10 step="10"><br></label>
        <label>Précision : <input type="number" id="precision" name="precision" min=10 step="10"><br></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
    <?php include "footer.php" ?>
 </body>
</html>

