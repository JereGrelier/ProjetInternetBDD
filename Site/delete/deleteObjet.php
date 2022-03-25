
<html>
 <head>
 <link rel="stylesheet" href="../css/monsite.css" />
 <title>Deleting object</title>
 <script>
    setTimeout(function(){location.href="../objets.php"} , 1000);
</script>
 </head>
 <body>
<?php
    include '../connect.php';
    $id = intval($_REQUEST['id']);
    $name =$_REQUEST['name'];
    $sql = 'delete from OBJET where IdObjet = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($id))) { 
        echo ('<h2>'.$name. ' successfully removed from the objects</h2>');
     } else {
        echo('Error');
     }
    ?>
    </body>
</html>