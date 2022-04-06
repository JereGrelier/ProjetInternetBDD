<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/monsite.css" />
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
  <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
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
        <th>Actions</th>
      </tr>
      <tbody>
        <?php
        $requete = "select * from ATTAQUE, TYPE where ATTAQUE.TypeAttaque = TYPE.idType order by ATTAQUE.nomAttaque asc";
        /* Si l'execution est reussie... */
        if ($res = $dbh->query($requete))
          /* ... on récupère un tableau stockant le résultat */
          $attaques =  $res->fetchAll();
        //echo print_r($espece);
        foreach ($attaques as $att) {
          echo '<td>' . $att['NomAttaque'] . '</td>';
          echo '<td>' . $att['NomType'] . '</td>';
          echo '<td>' . $att['Puissance'] . '</td>';
          echo '<td>' . $att['Precision'] . '</td>';
          echo '<td><form method="post" action="./delete/deleteAttaque.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="' . $att['IdAttaque'] . '"/>
                      <input type="hidden" name="name" value="' . $att['NomAttaque'] . '"/>
                    </form></td>';
          echo '</tr>' . "\n";
        }
        /*liberation de l'objet requete:*/
        $res->closeCursor();
        /*fermeture de la connexion avec la base*/
        $dbh = null;
        ?>
      </tbody>
    </table>
    <button id="openModal">Ajouter une attaque</button>
  </div>
  <div id="mydialog">
    <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une attaque</h1>
      <form action="./add/add-attaque.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <label>Type : <select name="type" id="type" required>
            <option value="">--Choisissez--</option>
            <?php include "./search/searchType.php" ?>
          </select><br> </label>
        <label>Puissance : <input type="number" id="power" name="power" min=10 step="10" max=250 required><br></label>
        <label>Précision : <input type="number" id="precision" name="precision" min=50 step="10" max=100 required><br></label>
        <input id="validation" type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;" /></button>
    </dialog>
  </div>

  <?php include "footer.php" ?>
  <script type="text/javascript" src="./js/modal.js"></script>
  
</body>

</html>