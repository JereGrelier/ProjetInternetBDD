

<?php
    include 'connect.php';
    $id = intval($_REQUEST['id']);
    $table = $_REQUEST['table'];
    $tableId = $_REQUEST['tableId'];
    $sql = 'delete from ? where ? = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($table, $tableId, $id)) { 
        echo ('Success');
     } else {
        echo('Error');
     }
    ?>