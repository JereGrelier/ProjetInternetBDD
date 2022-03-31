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
        <th>Actions</th>
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
                echo '<td>'; ($zone['IsJouable'] == 1) ?  $a='✓' :  $a='X'; echo $a.'</td>';
                echo '<td><form method="post" action="./delete/deleteProprietaire.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
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
      <button id="openModal" >Ajouter un propriétaire</button>
   </div>
  <div id="mydialog">
<dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter un Proprietaire</h1>
      <form action="./add/add-proprietaire.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <label>Jouable? <input type="checkbox" id="Jouable" name="Jouable"></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
</div>
  </div>
<?php include "footer.php" ?>
<script type="text/javascript" src="js/modal.js"></script>
 </body>
</html>
