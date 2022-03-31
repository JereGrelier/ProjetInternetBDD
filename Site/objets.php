<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/monsite.css" />
  <meta charset="utf-8" />
  <title>Liste des objets</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
  <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
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
        <th colspan="4">Localisation</th>
        <th>Actions</th>
      </tr>
      <?php
      $requete = "select * from OBJET order by OBJET.IdObjet asc";
      /* Si l'execution est reussie... */
      if ($res = $dbh->query($requete))
        /* ... on récupère un tableau stockant le résultat */
        $objets =  $res->fetchAll();
      //echo print_r($espece);
      foreach ($objets as $objet) {
        echo '<td>' . $objet['NomObjet'] . '</td>';
        echo '<td>';
        ($objet['IsUnique'] == 1) ?  $a = '✓' : $a = 'X';
        echo $a . '</td>';
        echo '<td>' . $objet['BonusPuissance'] . '</td>';
        $requete2 = "select * from LOCALISATION, ZONE where LOCALISATION.IdObjet = ".$zone['IdObjet']." and LOCALISATION.IdZone = ZONE.IdZone order by ZONE.IdZone asc";
        if ($res2 = $dbh->query($requete2))
          $zones = $res2->fetchAll();
        foreach ($zones as $zone) {
          echo '<td>' . $zone['NomZone'] . '</td>';
        }
        if (count($zones) < 4) {
          for ($i = 0; $i < 4 - count($zones); $i++) {
            echo '<td>-</td>';
          }
        }
        echo '<td><form method="post" action="./delete/deleteObjet.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="' . $objet['IdObjet'] . '"/>
                      <input type="hidden" name="name" value="' . $objet['NomObjet'] . '"/>
                    </form></td>';
        echo '</tr>' . "\n";
      }
      /*liberation de l'objet requete:*/
      $res->closeCursor();
      /*fermeture de la connexion avec la base*/
      $dbh = null;
      ?>
    </table>
    <button id="openModal">Ajouter un objet</button>
  </div>
  <div id="mydialog">
    <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter un objet</h1>
      <form action="./add/add-objet.php" method="post">
        <label>Nom : <input type="text" id="Name" name="Name" required><br></label>
        <label>Bonus : <input type="number" id="Bonus" name="Bonus" min="0" max="3" step="0.1" required><br></label>
        <label>Zone : <select name="Zone" id="Zone">
            <option value="">--Choisissez--</option>
            <?php include "./search/searchZone.php" ?>
          </select><br> </label>
        <label>Unique? <input type="checkbox" id="Unique" name="Unique"><br></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="/ProjetInternetBDD/Site/assets/376.png" alt="close" style="width: 50px; height: 50px;" /></button>
    </dialog>
  </div>
  </div>
  <?php include "footer.php" ?>
  <script type="text/javascript" src="js/modal.js"></script>
</body>

</html>