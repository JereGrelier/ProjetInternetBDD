<html>
<head>
<title>Redirection en HTML</title>

<script>
    setTimeout(function(){location.href="./objets.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newname = $_REQUEST['Name'];
    $bonus = $_REQUEST['Bonus'];
    $unique = $_REQUEST['Unique'] ? 1 : 0;
    $sql = 'insert into OBJET (NomObjet, BonusPuissance, IsUnique) values (:name, :bonus, :unique)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('name' => $newname, 'bonus'=>$bonus, 'unique' => $unique));
    ?>
</html>
