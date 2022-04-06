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
  <title>Liste des Zones</title>
</head>

<body>
  <?php include "topnav.php" ?>
  <div class="listeEspece">
    <h2>Liste des zones</h2>
    <div id="myGrid" style="width: 100em; position: absolute;left: 50px;border-radius: 15px;overflow: auto;font-size: large;" class="ag-theme-alpine-dark"></div>
  </div>
    <script type="text/javascript">
    <?php
    include "connect.php";
    $requete = "select * from ZONE";
    /* Si l'execution est reussie... */
    if ($res = $dbh->query($requete))
      /* ... on récupère un tableau stockant le résultat */
      $zones =  $res->fetchAll();
    /*liberation de l'objet requete:*/
    $res->closeCursor();
    /*fermeture de la connexion avec la base*/
    $dbh = null;
    ?>
    var zones = <?php echo json_encode($zones); ?>;

    var columnDefs = [{
        headerName: "Nom",
        field: 'name',
        resizable: true,
        filter: 'agTextColumnFilter',
        comparator: (valueA, valueB, nodeA, nodeB, isInverted) => {
                if (valueA == valueB) return 0;
                return (valueA > valueB) ? 1 : -1;
            }
      },
      {
        headerName: "Action",
        field: 'Action',
        resizable: true,
        sortable: false,
        cellRenderer: function(params) {
          // Display the image
          /* This is a function that will display the image of the species. */
          let link = `<form method="post" action="delete/deleteZone.php">
                      <button class="tableButton" type="submit" name="btnEnvoiForm" title="Envoyer"><h2>Supprimer</h2></button>
                      <input type="hidden" name="id" value=${params.value}/>
                    </form>`
          return link;
        }
      },
    ];

    // specify the data
    var rowData = [];
    zones.forEach(zone => {
      rowData.push({
        name: zone.NomZone,
        Action: zone.IdZone
      })
    });

    // let the grid know which columns and what data to use
    var gridOptions = {
      defaultColDef: {
        sortable: true,
        cellStyle: {
          fontSize: '22px',
          textAlign: 'center'
        }
      },
      columnDefs: columnDefs,
      rowData: rowData,
      rowHeight: 70,
      domLayout: 'autoHeight',
    };

    // setup the grid after the page has finished loading
    document.addEventListener('DOMContentLoaded', function() {
      var gridDiv = document.querySelector('#myGrid');
      new agGrid.Grid(gridDiv, gridOptions);
      gridOptions.api.sizeColumnsToFit();
    });
  </script>
    <button id="openModal"> Ajouter une zone</button>
  </div>
  <div id="mydialog">
    <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter une Zone</h1>
      <form action="./add/add-zone.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <input id="validation" type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;" /></button>
    </dialog>
  </div>
  <?php include "footer.php" ?>
  <script type="text/javascript" src="./js/modal.js"></script>
  
</body>

</html>