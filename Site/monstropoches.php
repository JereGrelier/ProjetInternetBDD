<!DOCTYPE html>
<html>

<head>
  <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
  <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="css/monsite.css" />
  <meta charset="utf-8" />
  <title>Liste des monstropochetrons</title>
</head>

<body>
  <?php include "topnav.php" ?>
  <div class="listeEspece">
    <h2>Liste des monstropochetrons</h2>
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
        <th colspan="4">Liste des Attaques</th>
        <th>Objet</th>
        <th>Propriétaire</th>
        <th>Actions</th>
      </tr>
      <tbody>
        <?php
        $requete1 = "select * from MONSTROPOCHE, ESPECE where MONSTROPOCHE.NumEspece = ESPECE.Numero order by MONSTROPOCHE.IdMonstropoche asc";
        /* Si l'execution est reussie... */
        if ($res1 = $dbh->query($requete1))
          /* ... on récupère un tableau stockant le résultat */
          $monstropoches =  $res1->fetchAll();
        $a = $monstropoches[0]['Numero'];

        //echo print_r($espece);
        foreach ($monstropoches as $monstropoche) {
          $requeteobj = "select * from MONSTROPOCHE, OBJET where IdMonstropoche = " . $monstropoche['IdMonstropoche'] . " and MONSTROPOCHE.IdObjet = OBJET.IdObjet";
          if ($resObjet = $dbh->query($requeteobj))
            $objets = $resObjet->fetchAll();
          $obj = isset($objets[0]['NomObjet']) ? $objets[0]['NomObjet'] : '-';

          $requeteproprio = "select * from MONSTROPOCHE, PROPRIETAIRE where IdMonstropoche = " . $monstropoche['IdMonstropoche'] . " and MONSTROPOCHE.IdProprietaire = PROPRIETAIRE.IdProprietaire";
          if ($resProprio = $dbh->query($requeteproprio))
            $proprios = $resProprio->fetchAll();
          $proprio = isset($proprios[0]['NomProprietaire']) ? $proprios[0]['NomProprietaire'] : '-';
          echo '<td>' . $monstropoche['Surnom'] . '</td>';
          echo '<td>' . $monstropoche['Etat'] . '</td>';
          echo '<td>' . $monstropoche['PV'] . '</td>';
          echo '<td>' . $monstropoche['PE'] . '</td>';
          echo '<td>' . $monstropoche['Genre'] . '</td>';
          echo '<td>' . $monstropoche['NomEspece'] . '</td>';
          $requete2 = "select * from MOVESET_MONSTROPOCHE, ATTAQUE where MOVESET_MONSTROPOCHE.IdAttaque = ATTAQUE.IdAttaque and MOVESET_MONSTROPOCHE.IdMonstropoche = " . $monstropoche['IdMonstropoche'] . " order by MOVESET_MONSTROPOCHE.idMonstropoche asc, MOVESET_MONSTROPOCHE.position asc";
          if ($res2 = $dbh->query($requete2))
            $attaques = $res2->fetchAll();
          foreach ($attaques as $attaque) {
            echo '<td>' . $attaque['NomAttaque'] . '</td>';
          }
          if (count($attaques) < 4) {
            for ($i = 0; $i < 4 - count($attaques); $i++) {
              echo '<td>-</td>';
            }
          }
          echo '<td>' . $obj . '</td>';
          echo '<td>' . $proprio . '</td>';
          echo '<td><form method="post" action="delete/deleteMonstropoche.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value="' . $monstropoche['IdMonstropoche'] . '"/>
                      <input type="hidden" name="name" value="' . $monstropoche['Surnom'] . '"/>
                    </form></td>';
          echo '</tr>' . "\n";
        }
        /*liberation de l'objet requete:*/
        $res1->closeCursor();
        $res2->closeCursor();
        /*fermeture de la connexion avec la base*/
        $dbh = null;
        echo '
      </tbody>
      </table>
      <button id="openModal"> Ajouter un monstropochetron</button>
   </div>
  <div id="mydialog">
<dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading" style="height: 420px;">
      <h1 id="modal-heading">Ajouter un monstropochetron</h1>
      <form action="./add/add-monstropoche.php" method="post">
        <label>Surnom : <input type="text" id="Nickname" name="Nickname" required><br></label>
        <label>PV : <input type="number" id="HP" name="HP" min=1 max="100" required><br></label>
        <label>Genre : <select name="Gender" id="Gender" required>
        <option value="">--Choisissez--</option>
        <option value="Male">Mâle</option>
        <option value="Femelle">Femelle</option>
        <option value="Binaire">Binaire</option>
        <option value="Non binaire">Non binaire</option>
        </select> <br> </label>
        <label>Espèce : <select name="Species" id="Species" required>
        <option value="null">--Choisissez--</option>';
        include "./search/searchEspece.php";
        echo '</select> <br></label>
        <label>Attaque : <select name="Attack" id="Attack" required>
        <option value="null">--Choisissez--</option>';
        include "./search/searchMoveset-Espece.php";
        echo '
        </select> <br></label>
        <label>Attaque : <select name="Attacke" id="Attacke">
        <option value="null">--Choisissez--</option>';
        include "./search/searchMoveset-Espece.php";
        echo '
        </select> <br></label>
        <label>Attaque : <select name="Attackee" id="Attackee">
        <option value="null">--Choisissez--</option>';
        include "./search/searchMoveset-Espece.php";
        echo '
        </select> <br></label>
        <label>Attaque : <select name="Attackeee" id="Attackeee">
        <option value="null">--Choisissez--</option>';
        include "./search/searchMoveset-Espece.php";
        echo '
        </select> <br></label>
        <label>Objet : <select name="Object" id="Object">
        <option value=null>--Choisissez--</option>';
        include "./search/searchObjet.php";
        echo '</select> <br></label>
        <label>Propriétaire : <select name="Owner" id="Owner">
        <option value=null>--Choisissez--</option>';
        include "./search/searchProprietaire.php";
        echo '</select> <br></label>
        <input id="validation" type="submit" value="valider">
      </form>
      <button onclick="document.getElementById(\'mydialog\').style.visibility=\'hidden\'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;"/></button>
    </dialog>
</div>
  </div>;' ?>
        <?php include "footer.php" ?>
        <script type="text/javascript" src="./js/modal.js"></script>
        
</body>

</html>