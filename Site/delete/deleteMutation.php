
<html>
 <head>
 <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
        <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
        <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
 <link rel="stylesheet" href="../css/monsite.css" />
 <title>Suppression zone</title>
 <script>
    setTimeout(function(){location.href="../mutations.php"} , 1000);
</script>
 </head>
 <body>
<?php
    include '../connect.php';
    $id = intval($_REQUEST['id']);
    $idp = intval($_REQUEST['idp']);
    $pre =$_REQUEST['pre'];
    $post =$_REQUEST['post'];
    $sql = 'delete from MUTATION where IdPreMutation = ? and IdPostMutation = ? ';
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($id, $idp))) { 
        echo ('<h2>La Mutation de '.$pre. ' en '.$post.' a bien été supprimée de la base</h2>');
     } else {
        echo('<h2>Error</h2>');
     }
    ?>
    </body>
</html>