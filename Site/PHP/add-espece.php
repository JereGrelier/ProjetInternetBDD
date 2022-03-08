<html>
<head>
<title>Redirection en HTML</title>

<script>
    setTimeout(function(){location.href="/"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newnumber = intval($_REQUEST['number']);
    $newname = $_REQUEST['name'];
    $zone = $_REQUEST['zone'];
    $type = $_REQUEST['type'];
    $sql = 'insert into ESPECE (numero, nomEspece, type, evolution, zone) values (:number, :name, :type, 1, :zone)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('number'=> $newnumber, 'name' => $newname, 'type' => $type, 'zone' => $zone));
    ?>
</html>
