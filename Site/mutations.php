<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <script src="js/nav.js"></script> 
 <meta charset="utf-8"/>
  <title>Liste des mutations</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    <h2>Liste des mutations</h2>
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <table>
          <tr class="headerListEspece">
        <th>Premutation</th>
        <th>Postmutation</th>
        <th>Objet</th>
        <th>PE Requis</th>
        <th colspan="2">Sprites</th>
          </tr>
        <?php
          $requete = "select distinct * from MUTATION, ESPECE where ESPECE.Numero = MUTATION.IdPreMutation order by ESPECE.numero asc";
          $requete2 = "select distinct * from MUTATION, ESPECE where ESPECE.Numero = MUTATION.IdPostMutation order by ESPECE.numero asc";
          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $espece =  $res->fetchAll();
                //echo print_r($espece);
                
                foreach($espece as $esp) {
                  /* ... on récupère un tableau stockant le résultat */
                  $requete2 = "select distinct * from MUTATION, ESPECE where ESPECE.Numero = ".$esp['IdPostMutation']." order by ESPECE.numero asc";
                  if($res2 = $dbh->query($requete2))
                    $especePost =  $res2->fetchAll();
                    foreach($especePost as $post) {
                      echo "\t".'<tr><td>'.$esp['NomEspece'].'</td>';
                      echo '<td>'.$post['NomEspece'].'</td>';
                      echo '<td>'.$esp['IdObjet'].'</td>';
                      echo '<td>'.$esp['PE_Requis'].'</td>';
                      echo '<td> <img src="'.$esp['Sprite'].'"/></td>';
                      echo '<td> <img src="'.$post['Sprite'].'"/></td>';
                    }
                }
                /* echo '<td><form method="post" action="./delete/deleteEspece.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><img class="delete" src="../assets/376.png" alt="" /><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="'.$esp['Numero'].'"/>
                      <input type="hidden" name="name" value="'.$esp['NomEspece'].'"/>
                    </form></td>'; */
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
