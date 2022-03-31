<html>

<head>
    <title>Redirection en HTML</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
    <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
    <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <script>
        setTimeout(function() {
            location.href = "../monstropoches.php"
        }, 2000);
    </script>
</head>

<body>
</body>
<?php
include '../connect.php';
$newnickame = $_REQUEST['Nickname'];
$HP = intval($_REQUEST['HP']);
$EXP = intval('0');
$state = 'Repos';
$gender = $_REQUEST['Gender'];
$species = intval($_REQUEST['Species']);
$object = $_REQUEST['Object'] == "null" ? NULL : intval($_REQUEST['Object']);
$attack = intval($_REQUEST['Attack']);
$attacke = $_REQUEST['Attacke'] == "null" ? NULL : $_REQUEST['Attacke'];
$attackee = $_REQUEST['Attackee'] == "null" ? NULL : $_REQUEST['Attackee'];
$attackeee = $_REQUEST['Attackeee'] == "null" ? NULL : $_REQUEST['Attackeee'];
$owner = $_REQUEST['Owner'] == "null" ? NULL : intval($_REQUEST['Owner']);
$sql = 'insert into MONSTROPOCHE (surnom, etat, pe, pv , genre, numEspece, idObjet, idProprietaire) values (:surnom, :state, :exp, :pv, :genre, :espece, :objet, :proprietaire);';
$sql2 = 'insert into MOVESET_MONSTROPOCHE (IdAttaque, idMonstropoche, Position) values (:attaque, :idMonstropoche, 1), (:attaquee, :idMonstropoche, 2), (:attaqueee, :idMonstropoche, 3), (:attaqueeee, :idMonstropoche, 4);';
$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array(
    'surnom' => $newnickame, 'pv' => $HP, 'genre' => $gender, 'exp' => $EXP, 'state' => $state,
    'espece' => $species, 'objet' => $object, 'proprietaire' => $owner
));
$requete1 = "select * from MONSTROPOCHE where MONSTROPOCHE.Surnom = '".$newnickame."' and MONSTROPOCHE.NumEspece = '". $species."'";
/* Si l'execution est reussie... */
if ($res1 = $dbh->query($requete1))
  /* ... on récupère un tableau stockant le résultat */
  $monstropoches =  $res1->fetchAll();
  print_r($monstropoches);
  echo $monstropoches[0]['IdMonstropoche'];
$sth2 = $dbh->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth2->execute(array(
    'attaque' => $attack, 'attaquee' => $attacke,
    'attaqueee' => $attackee, 'attaqueeee' => $attackeee, 'idMonstropoche' => $monstropoches[0]['IdMonstropoche']
));
?>

</html>