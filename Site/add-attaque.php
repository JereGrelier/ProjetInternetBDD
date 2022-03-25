<html>
<head>
<title>Redirection en HTML</title>

<script>
    setTimeout(function(){location.href="./attaques.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newname = $_REQUEST['name'];
    $type = $_REQUEST['type'];
    $precision = intval($_REQUEST['precision']);
    $power = intval($_REQUEST['power']);
    $sql = 'insert into ATTAQUE (`NomAttaque`,`Puissance`,`Precision`,`TypeAttaque`) values (:name, :power, :precision, :type);';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('name' => $newname, 'power' => $power, 'precision' => $precision, 'type' => $type));
    ?>
</html>
