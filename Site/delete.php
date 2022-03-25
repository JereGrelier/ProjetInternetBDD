

<?php 
    include 'connect.php';
    $id = intval($_REQUEST['id']);
    $table = $_REQUEST['table'];
    $tableId = $_REQUEST['tableId'];
    $sql = 'delete from :TABLE where :TABLEID = :id ';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('TABLE' => $table, 'TABLEID' => $tableId, 'id' => $id));
    echo $sth;
    ?>