<html>
<head>
<title>Redirection en HTML</title>

<script>
    //setTimeout(function(){location.href="./monstropoches.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include 'connect.php';
    $newnickame = $_REQUEST['nickname'];
    $state = 'Repos';
    $EXP = intval('0');
    $HP = intval($_REQUEST['HP']);
    $gender = $_REQUEST['gender'];
    $species = $_REQUEST['species'];
    $object = intval($_REQUEST['object']);
    $attack = intval($_REQUEST['attack']);
    $owner = intval($_REQUEST['owner']);
    $sql = 'insert into MONSTROPOCHE (surnom, etat, pe, pv , genre, espece, objet, attaque, proprietaire) values (:surnom, :etat, :pe, :pv, :genre, :espece, :objet, :proprietaire); insert into HABITAT(numEspece, IdZone) values(:number, :zone)';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('surnom'=> $newnickame, 'etat' => $state, 'pe' => $EXP, 'pv' => $HP, 'genre' => $gender, 'espece' => $species, 'objet' => $object, 'attaque' => $attack, 'proprietaire' => $owner));
    ?>
</html>
