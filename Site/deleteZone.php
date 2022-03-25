

<?php
    include 'connect.php';
    $id = intval($_REQUEST['id']);
    $sql = 'delete from ZONE where IdZone = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($id))) { 
        echo ('Success');
     } else {
        echo('Error');
     }
    ?>