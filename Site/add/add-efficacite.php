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
    setTimeout(function(){location.href="../efficacite.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include '../connect.php';
    $def = $_REQUEST['defense'];
    $att = $_REQUEST['attaque'];
    $coef = $_REQUEST['coefficient'];
    $sql = 'insert into EFFICACITE values (:att, :def, :coef)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('att' => $att, 'def' => $def, 'coef' => $coef));
    echo '<h2>Ajout Reussi</h2>'
    ?>
</html>
