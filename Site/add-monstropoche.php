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
    $HP = intval($_REQUEST['HP']);
    $gender = $_REQUEST['Gender'];
    $species = intval($_REQUEST['Species']);
    $object = intval($_REQUEST['Object']);
    $attack = intval($_REQUEST['Attack']);
    $owner = intval($_REQUEST['Owner']);
    $idM = 'select max(IdMonstropoche) from MONSTROPOCHE' + 1;
    $sql = 'insert into MONSTROPOCHE (surnom, etat, pe, pv , genre, numEspece, idObjet, idProprietaire) values (:surnom, Repos, 0, :pv, :genre, :espece, :objet, :proprietaire); insert into MOVESET_MONSTROPOCHE (IdAttaque, IdMonstopoche, Position) values (:attaque, :idMonstropoche, 1);';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('surnom'=> $newnickame, 'pv' => $HP, 'genre' => $gender, 'espece' => $species, 'objet' => $object, 'proprietaire' => $owner, 'attaque' => $attack, 'idMonstropoche'=>$idM));
    ?>
</html>
