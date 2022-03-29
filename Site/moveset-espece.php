<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <script src="js/nav.js"></script> 
 <meta charset="utf-8"/>
 <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
        <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
        <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
  <title>Liste des espèces</title>
 </head>
 <body>
 <?php include "topnav.php" ?>
    <div class="listeEspece">
    
        <?php
        include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */ ?>
        <?php
          $requete = "select * from ESPECE, TYPE, MOVESET_ESPECE, ATTAQUE where MOVESET_ESPECE.NumEspece = ".intval($_REQUEST['id'])." and ESPECE.Numero = MOVESET_ESPECE.NumEspece and
          MOVESET_ESPECE.IdAttaque = ATTAQUE.IdAttaque and ATTAQUE.TypeAttaque = TYPE.IdType ";          /* Si l'execution est reussie... */
          if($res = $dbh->query($requete))
              /* ... on récupère un tableau stockant le résultat */
                $moveset =  $res->fetchAll();
                echo '<h2>Moveset de '.$moveset[0]['NomEspece'].'</h2>';
                $num = $moveset[0]['Numero'];
                echo '<table>
                <tr class="headerListEspece">
              <th>Nom</th>
              <th>Type</th>
              <th>Puissance</th>
              <th>Precision</th>
              <th>Actions</th>
                </tr>';
                foreach($moveset as $move) {
                echo '<tr><td>'.$move['NomAttaque'].'</td>';
                echo '<td>'.$move['NomType'].'</td>';
                echo '<td>'.$move['Puissance'].'</td>';
                echo '<td>'.$move['Precision'].'</td>';
                echo '<td><form method="post" action="./delete/deleteFromMovesetEspece.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="IdAttaque" value="'.$move['IdAttaque'].'"/>
                      <input type="hidden" name="NumEspece" value="'.$move['Numero'].'"/>
                    </form></td></tr>';
                }
                /*liberation de l'objet requete:*/
            $res->closeCursor();
            /*fermeture de la connexion avec la base*/
            $dbh = null;
      echo'  
      <td id="sprite"></td>
      </table>
      <button onclick="document.getElementById(\'mydialog\').style.visibility = \'visible\'">Ajouter une espèce</button>
   </div>
   <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une attaque au moveset</h1>
      <form action="./add-to-moveset.php" method="post">
      <label>PE Requis : <input type="number" id="PE_Requis" name="PE_Requis" min="1" max="100" path="1" required><br>
      <label>Attaque : <select name="Attack" id="Attack" required>
        <option value="">--Choisissez--</option>
        ';
        include "searchAttaque.php";
        echo'</select> <br></label>
        <input type="hidden" name="Numero" value='.$num.' />
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById(\'mydialog\').style.visibility=\'hidden\'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>'
    ?>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
