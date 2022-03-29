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
    setTimeout(function(){location.href="./monstropoches.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newnickame = $_REQUEST['Nickname'];
    $HP = intval($_REQUEST['HP']);
    $EXP = intval('0');
    $state = 'Repos';
    $gender = $_REQUEST['Gender'];
    $species = intval($_REQUEST['Species']);
    $object = intval($_REQUEST['Object']);
    $attack = intval($_REQUEST['Attack']);
    $owner = intval($_REQUEST['Owner']);
    $idM = 'select max(IdMonstropoche) from MONSTROPOCHE' + 1;
    $sql = 'insert into MONSTROPOCHE (surnom, etat, pe, pv , genre, numEspece, idObjet, idProprietaire) values (:surnom, :state, :exp, :pv, :genre, :espece, :objet, :proprietaire); insert into MOVESET_MONSTROPOCHE (IdAttaque, IdMonstopoche, Position) values (:attaque, :idMonstropoche, 1);';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('surnom'=> $newnickame, 'pv' => $HP, 'genre' => $gender, 'exp'=>$EXP, 'state'=>$state,  'espece' => $species, 'objet' => $object, 'proprietaire' => $owner, 'attaque' => $attack, 'idMonstropoche'=>$idM));
    ?>
</html>
