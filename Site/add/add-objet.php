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
    setTimeout(function(){location.href="../objets.php"} , 1000);
</script>
</head>

<body>
</body>
<?php 
    include '../connect.php';
    $newname = $_REQUEST['Name'];
    $localisation = $_REQUEST['Zone'];
    $bonus = $_REQUEST['Bonus'];
    $idOR = 'select max(IdObjet) from OBJET;';
    if($resIdO = $dbh->query($idOR))
    $idO =  $resIdO->fetchAll();
    $unique = isset($_REQUEST['Unique']) ? 1 : 0;
    $sql = 'insert into OBJET (NomObjet, BonusPuissance, IsUnique) values (:name, :bonus, :unique);
            insert into LOCALISATION values (:id, :zone)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('name' => $newname, 'bonus'=>$bonus, 'unique' => $unique, 'id' => $idO[0], 'zone' => $localisation ));
    ?>
</html>
