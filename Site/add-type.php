<html>
<head>
<title>Redirection en HTML</title>

<script>
    setTimeout(function(){location.href="./types.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newname = $_REQUEST['name'];
    $sql = 'insert into TYPE (NomType) values (:name)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('name' => $newname,));
    ?>
</html>
