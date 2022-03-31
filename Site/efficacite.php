<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/monsite.css" />
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="/ProjetInternetBDD/Site/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/ProjetInternetBDD/Site/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/ProjetInternetBDD/Site/assets/icons/favicon-16x16.png">
    <link rel="manifest" href="/ProjetInternetBDD/Site/assets/icons/site.webmanifest">
    <link rel="mask-icon" href="/ProjetInternetBDD/Site/assets/icons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/ProjetInternetBDD/Site/assets/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/ProjetInternetBDD/Site/assets/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script type="text/javascript" src="./js/modal.js"></script>

    <title>Efficacite entre les types</title>
</head>

<body>
    <?php include "topnav.php" ?>
    <?php include "connect.php" ?>
    <?php
    $requete = "select * from TYPE";
    /* Si l'execution est reussie... */
    if ($res = $dbh->query($requete))
        /* ... on récupère un tableau stockant le résultat */
        $attaques =  $res->fetchAll();
    /*liberation de l'objet requete:*/
    $res->closeCursor();
    /*fermeture de la connexion avec la base*/

    $requeteCoef = "select * from TYPE, EFFICACITE where EFFICACITE.IdTypeDefense = TYPE.IdType ";

    if ($res2 = $dbh->query($requeteCoef))
        /* ... on récupère un tableau stockant le résultat */
        $typeAttaque =  $res2->fetchAll();
    /*liberation de l'objet requete:*/
    $res2->closeCursor();

    $dbh = null;
    ?>

    <div class="TableEff">
        <h2>Table des efficacites</h2>
        <div id="myGrid" style="width: 95%; height: 62%;position: fixed;left: 50px;border-radius: 15px;overflow: auto;font-size: larger;" class="ag-theme-alpine"></div>
    </div>
    <script type="text/javascript">
        var Types = <?php echo json_encode($attaques); ?>;
        var TypesA = <?php echo json_encode($typeAttaque); ?>;
        var columnDefs = [{
            headerName: "Defense\\Attaque",
            field: 'typesD'
        }];
        Types.forEach(type => {
            columnDefs.push({
                headerName: type.NomType,
                field: type.IdType
            });
        });

        // specify the data
        var rowData = [];
        TypesA.forEach(typeA => {
            if (rowData.includes(typeA.NomType))
            {
                console.log("Dela ja");
            }
                console.log(typeA);
                rowData.push({
                    typesD: typeA.NomType,
                    1: 0.5,
                    2: 1,
                    4: 2,
                    5: 0,
                    6: 0.5,
                    7: 1,
                    8: 1.5,
                    9: 1
                })
        })

        // let the grid know which columns and what data to use
        var gridOptions = {
            columnDefs: columnDefs,
            rowData: rowData
        };

        // setup the grid after the page has finished loading
        document.addEventListener('DOMContentLoaded', function() {
            var gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);
        });
    </script>
</body>