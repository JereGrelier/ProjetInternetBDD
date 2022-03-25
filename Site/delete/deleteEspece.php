
<html>
 <head>
 <link rel="stylesheet" href="css/monsite.css" />
 <title>Deleting zone</title>
 <script>
    setTimeout(function(){location.href="./zones.php"} , 1000);
</script>
 </head>
 <body>
<?php
    include '../connect.php';
    $id = intval($_REQUEST['id']);
    $name =$_REQUEST['name'];
    $sql = 'delete from ESPECE where Numero = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($id))) { 
        echo ('<h2>Espece '.$name. 'successfully removed from the base</h2>');
     } else {
        echo('Error');
     }
    ?>
    </body>
</html>