

<?php
    include 'connect.php';
    $id = intval($_REQUEST['id']);
    $table = $_REQUEST['table'];
    $tableId = $_REQUEST['tableId'];
    $sql = 'delete from ? where ? = ? ';
    $sth = $dbh->prepare($sql, array($table, $tableId, $id));
    if ($sth->execute()) { 
        echo ('Success');
     } else {
        echo('Error');
     }
    ?>