<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/monsite.css" />
  <script src="./js/nav.js"></script>
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
        <th>Actions</th>
      </tr>
      <tbody>
        <?php
        $requete = "select distinct * from MUTATION, ESPECE where ESPECE.Numero = MUTATION.IdPreMutation order by ESPECE.numero asc";
        $requete2 = "select distinct * from MUTATION, ESPECE where ESPECE.Numero = MUTATION.IdPostMutation order by ESPECE.numero asc";
        /* Si l'execution est reussie... */
        if ($res = $dbh->query($requete))
          /* ... on récupère un tableau stockant le résultat */
          $espece =  $res->fetchAll();
        //echo print_r($espece);
        $i = 0;
        foreach ($espece as $esp) {
          /* ... on récupère un tableau stockant le résultat */
          $requete2 = "select distinct * from MUTATION, ESPECE where ESPECE.Numero = " . $esp['IdPostMutation'] . " order by ESPECE.numero asc";
          if ($res2 = $dbh->query($requete2))
            $especePost =  $res2->fetchAll();
          echo "\t" . '<tr><td>' . $esp['NomEspece'] . '</td>';
          echo '<td>' . $especePost[$i]['NomEspece'] . '</td>';
          if (isset($esp['IdObjet'])) {
            $requeteObj = "select * from OBJET where IdObjet = " . $esp['IdObjet'];
            if ($resObj = $dbh->query($requeteObj))
              $obj = $resObj->fetch();
            echo '<td>' . $obj['NomObjet'] . '</td>';
          } else echo '<td>-</td>';
          echo '<td>' . $esp['PE_Requis'] . '</td>';
          echo '<td> <img src="' . $esp['Sprite'] . '"/></td>';
          echo '<td> <img src="' . $especePost[$i]['Sprite'] . '"/></td>';
          echo '<td><form method="post" action="./delete/deleteMutation.php">
        <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
        <input type="hidden" name="id" value="' . $esp['IdPreMutation'] . '"/>
        <input type="hidden" name="idp" value="' . $esp['IdPostMutation'] . '"/>
        <input type="hidden" name="pre" value="' . $esp['NomEspece'] . '"/>
        <input type="hidden" name="post" value="' . $especePost[$i]['NomEspece'] . '"/>
      </form></td>';
          $i = $i + 1;
        }
        /*liberation de l'objet requete:*/
        $res->closeCursor();
        /*fermeture de la connexion avec la base*/
        $dbh = null;
        ?>
      </tbody>
    </table>
    <button id="openModal"> Ajouter une mutation</button>
  </div>
  <div id="mydialog">
    <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une Mutation</h1>
      <form action="./add/add-mutation.php" method="post">
        <label>Premutation : <select name="pre" id="pre" required>
            <option value="">--Choisissez--</option>
            <?php include "./search/searchEspece.php" ?>
          </select><br> </label>
        <label>PostMutation : <select name="post" id="post" required>
            <option value="">--Choisissez--</option>
            <?php include "./search/searchEspece.php" ?>
          </select> <br></label>
        <label>PE Requis : <input type="number" id="PERequis" name="PERequis" min="1" max="100" step="1" required><br></label>
        <label>Objet : <select name="obj" id="obj">
            <option value=null>--Choisissez--</option>
            <option value="">Aucun</option>
            <?php include "./search/searchObjet.php" ?>
          </select> <br></label>
        <input type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;" /></button>
    </dialog>
  </div>
  <?php include "footer.php" ?>
  <script type="text/javascript" src="./js/modal.js"></script>
  <script type="text/javascript" src="./js/tri.js"></script>
</body>

</html>