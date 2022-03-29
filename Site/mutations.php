<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <script src="js/nav.js"></script> 
 <meta charset="utf-8"/>
 <link rel="apple-touch-icon" sizes="180x180" href="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/favicon-16x16.png">
        <link rel="manifest" href="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/site.webmanifest">
        <link rel="mask-icon" href="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="ProjetInternetBDD/Site/ProjetsBDD/assets/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
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
      <button onclick="document.getElementById('mydialog').style.visibility = 'visible'">Ajouter une mutation</button>
   </div>
   <dialog open id="mydialog" class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une Mutation</h1>
      <form action="./add-mutation.php" method="post">
        <label>Premutation : <select name="pre" id="pre">
        <option value="">--Choisissez--</option>
        <?php include "searchEspece.php" ?>
        </select><br> </label>
        <label>PostMutation : <select name="post" id="post">
        <option value="">--Choisissez--</option>
        <?php include "searchEspece.php" ?>
        </select> <br></label>
        <label>PE Requis : <input type="number" id="PERequis" name="PERequis" min="1" max="100" step="1" required><br></label>
        <label>Objet : <select name="post" id="post">
        <option value=null>--Choisissez--</option>
        <option value="">Aucun</option>
        <?php include "searchObjet.php" ?>
        </select> <br></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
  </div>
<?php include "footer.php" ?>
 </body>
</html>
