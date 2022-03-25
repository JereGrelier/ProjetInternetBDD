<html>
<head>
<title>Redirection en HTML</title>

<script>
    setTimeout(function(){location.href="./monstropoches.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newnickame = $_REQUEST['nickname'];
    $HP = intval($_REQUEST['HP']);
    $gender = $_REQUEST['gender'];
    $object = intval($_REQUEST['object']);
    $owner = intval($_REQUEST['owner']);
    $sql = 'insert into MONSTROPOCHE (surnom, pv , genre, ) values (:number, :name, :TypeEspece); insert into HABITAT(numEspece, IdZone) values(:number, :zone)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('number'=> $newnumber, 'name' => $newname, 'TypeEspece' => $type, 'zone' => $zone));
    ?>
</html>
