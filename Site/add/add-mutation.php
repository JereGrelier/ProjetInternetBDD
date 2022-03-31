<html>
<head>
<title>Redirection en HTML</title>
<link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
        <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
        <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
<script>
    setTimeout(function(){location.href="../mutations.php"} , 500);
</script>
</head>

<body>
</body>
<?php 
    include '../connect.php';
    $pre = $_REQUEST['pre'];
    $post = $_REQUEST['post'];
    $PERequis = intval($_REQUEST['PERequis']);
    $obj = $_REQUEST['obj'] == 'null' ? NULL : $_REQUEST['obj'];
    $sql = 'insert into MUTATION values (:pre, :post, :obj, :pe);';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('pre' => $pre, 'post' => $post, 'obj' => $obj, 'pe' => $PERequis));
    ?>
</html>
