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
    $newnickame = $_REQUEST['Nickname'];
    $state = 'Repos';
    $EXP = intval('0');
    $HP = intval($_REQUEST['HP']);
    $gender = $_REQUEST['Gender'];
    $species = $_REQUEST['Species'];
    $object = intval($_REQUEST['Object']);
    $attack = intval($_REQUEST['Attack']);
    $owner = intval($_REQUEST['Owner']);
    $sql = 'insert into MONSTROPOCHE (surnom, etat, pe, pv , genre, espece, objet, attaque, proprietaire) values (:surnom, :etat, :pe, :pv, :genre, :espece, :objet, :proprietaire);';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('surnom'=> $newnickame, 'etat' => $state, 'pe' => $EXP, 'pv' => $HP, 'genre' => $gender, 'espece' => $species, 'objet' => $object, 'attaque' => $attack, 'proprietaire' => $owner));
    ?>
</html>
