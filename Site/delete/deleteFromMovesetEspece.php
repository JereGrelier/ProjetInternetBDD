
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
 <link rel="stylesheet" href="../css/monsite.css" />
 <title>Deleting zone</title>
 <script>
    setTimeout(function(){location.href="../especes.php"} , 1000);
</script>
 </head>
 <body>
<?php
    include '../connect.php';
    $numero = intval($_REQUEST['NumEspece']);
    $name =$_REQUEST['name'];
    $idAttaque = $_REQUEST['IdAttaque'];
    $sql = 'delete from MOVESET_ESPECE where NumEspece = ? and IdAttaque = ?';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($numero, $idAttaque))) { 
        echo ('<h2>Suppression réussie</h2>');
     } else {
        echo('<h2>Error</h2>');
     }
    ?>
    </body>
</html>