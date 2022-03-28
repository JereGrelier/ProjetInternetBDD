
<html>
 <head>
 <link rel="stylesheet" href="../css/monsite.css" />
 <title>Deleting owner</title>
 <script>
    setTimeout(function(){location.href="../proprietaires.php"} , 1000);
</script>
 </head>
 <body>
<?php
    include '../connect.php';
    $id = intval($_REQUEST['id']);
    $name =$_REQUEST['name'];
    $sql = 'delete from PROPRIETAIRE where IdProprietaire = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($id))) { 
        echo ('<h2>'.$name. ' successfully removed from the owners</h2>');
     } else {
        echo('Error');
     }
    ?>
    </body>
</html>