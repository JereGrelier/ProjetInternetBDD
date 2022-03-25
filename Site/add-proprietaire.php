<html>
<head>
<title>Redirection en HTML</title>

<script>
    setTimeout(function(){location.href="./proprietaires.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newname = $_REQUEST['name'];
    $isJouable = $_REQUEST['Jouable'] ? 1 : 0;
    $sql = 'insert into PROPRIETAIRE (NomProprietaire, IsJouable) values (:name, :jouable)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('name' => $newname, 'jouable' => $isJouable));
    ?>
</html>
