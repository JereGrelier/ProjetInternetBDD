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
    setTimeout(function(){location.href="../especes.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include '../connect.php';
    $newnumber = intval($_REQUEST['number']);
    $newname = $_REQUEST['name'];
    $zone = intval($_REQUEST['zone']);
    $type = intval($_REQUEST['type']);
    $type2 = isset($_REQUEST['type-deux']) ? $_REQUEST['type-deux'] : NULL;
    $sprite = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/'.intval($_REQUEST['number']).'.png';
    $sql = 'insert into ESPECE (numero, nomEspece, TypeEspece, TypeEspece2 , Sprite) values (:number, :name, :TypeEspece, :Type2, :sprite); insert into HABITAT(numEspece, IdZone) values(:numberh, :zone)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('number'=> $newnumber, 'name' => $newname, 'TypeEspece' => $type, 'Type2'=>$type2, 'zone' => $zone, 'sprite' => $sprite, 'numberh' => $newnumber));
    ?>
</html>
