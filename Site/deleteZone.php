

<?php
    include 'connect.php';
    $id = intval($_REQUEST['id']);
    $sql = 'delete from ZONE where ZoneId = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($id))) { 
        echo ('Success');
     } else {
        echo('Error');
     }
    ?>