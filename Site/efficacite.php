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
        <div id="myGrid" style="width: 100em; height: 100%;position: fixed;left: 50px;border-radius: 15px;overflow: auto;font-size: large;" class="ag-theme-alpine"></div>
    </div>
    <script type="text/javascript">
        var Types = <?php echo json_encode($attaques); ?>;
        var TypesA = <?php echo json_encode($typeAttaque); ?>;
        var columnDefs = [{
            headerName: "Defense\\Attaque",
            field: 'typesD',
            sortable: true
        }];
        Types.forEach(type => {
            columnDefs.push({
                headerName: type.NomType,
                field: type.IdType,
                sortable: true
            });
        });

        // specify the data
        var rowData = [];
        TypesA.forEach(typeA => {
            if (!rowData.find(element => element.typesD === typeA.NomType)) {
                rowData.push({
                    typesD: typeA.NomType,
                })
            }
            var AttaqueT = typeA.IdTypeAttaque;
            rowData.find(element => element.typesD === typeA.NomType)[AttaqueT] = typeA.Coefficient;
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
            gridOptions.api.sizeColumnsToFit();
        });
    </script>
    <button id="openModal"> Ajouter une efficacité</button>
    <div id="mydialog">
        <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading" class="effi">
            <h1 id="modal-heading">Ajouter une Efficacité</h1>
            <form action="./add/add-efficacite.php" method="post">
                <label>Type attaque : <select name="attaque" id="attaque" required>
                        <option value="">--Choisissez--</option>
                        <?php include "./search/searchType.php" ?>
                    </select><br> </label>
                <label>Type défense : <select name="defense" id="defense" required>
                        <option value="null">--Choisissez--</option>
                        <?php include "./search/searchType.php" ?>
                    </select> <br></label>
                <label>PE Requis : <input type="number" id="coefficient" name="coefficient" min="0" max="3" step="0.5" required><br></label>
                <input type="submit" value="valider">
            </form>
            <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;" /></button>
        </dialog>
    </div>
    <script type="text/javascript" src="./js/modal.js"></script>
</body>