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
    $zone = intval($_REQUEST['zone']);
    $type = intval($_REQUEST['type']);
    $sql = 'insert into ESPECE (numero, nomEspece, TypeEspece) values (:number, :name, :TypeEspece); insert into HABITAT(numEspece, IdZone) values(:number, :zone)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('number'=> $newnumber, 'name' => $newname, 'TypeEspece' => $type, 'zone' => $zone));
    ?>
</html>
