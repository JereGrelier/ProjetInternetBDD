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
        <link rel="stylesheet" href="../css/monsite.css" />
<script>
    setTimeout(function(){location.href="../attaques.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include '../connect.php';
    $newname = $_REQUEST['name'];
    $type = $_REQUEST['type'];
    $precision = intval($_REQUEST['precision']);
    $power = intval($_REQUEST['power']);
    $sql = 'insert into ATTAQUE (`NomAttaque`,`Puissance`,`Precision`,`TypeAttaque`) values (:name, :power, :precision, :type);';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('name' => $newname, 'power' => $power, 'precision' => $precision, 'type' => $type));
    echo '<h2>Ajout Reussi</h2>'
    ?>
</html>
