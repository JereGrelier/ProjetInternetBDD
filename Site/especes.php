<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/monsite.css" />
  <script src="./js/nav.js"></script>
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
  <title>Liste des espèces</title>
</head>

<body>
  <?php include "topnav.php" ?>
  <div class="listeEspece">
   
  </div>

  <div class="TableEff">
  <h2>Liste des espèces de monstropochetrons</h2>
    <div id="myGrid" style="width: 100em; height: 100%;position: fixed;left: 50px;border-radius: 15px;overflow: auto;font-size: large;" class="ag-theme-alpine"></div>
  </div>
  <script type="text/javascript">
    <?php
  include "connect.php";
  $requete = "select * from ESPECE, TYPE, HABITAT, ZONE where ESPECE.TypeEspece = TYPE.idType and ESPECE.Numero = HABITAT.NumEspece and HABITAT.IdZone = ZONE.IdZone order by ESPECE.numero asc";
  /* Si l'execution est reussie... */
  if ($res = $dbh->query($requete))
    /* ... on récupère un tableau stockant le résultat */
    $espece =  $res->fetchAll();
  /*liberation de l'objet requete:*/
  $res->closeCursor();
  /*fermeture de la connexion avec la base*/
  $dbh = null;
  ?>
    var esp = <?php echo json_encode($espece); ?>;

    var columnDefs = [{
        headerName: "Numero",
        field: 'num',
        resizable: true,
        filter: 'agNumberColumnFilter'

      },
      {
        headerName: "Nom",
        field: 'name',
        resizable: true,
        filter: 'agTextColumnFilter'
      },
      {
        headerName: "Type 1",
        field: 'TypeUn',
        resizable: true,
        filter: 'agTextColumnFilter'
      },
      {
        headerName: "Type 2",
        field: 'TypeDeux',
        resizable: true,
        filter: 'agTextColumnFilter'
      },
      {
        headerName: "Zone",
        field: 'Zone',
        resizable: true,
        filter: 'agTextColumnFilter'
      },
      {
        headerName: "Image",
        field: 'img',
        resizable: true,
        cellRenderer: function(params) {
                // Display the image
                /* This is a function that will display the image of the species. */
                let link = `<img src=${params.value} alt=${params.value} />`;
                return link;
            }
      },
      {
        headerName: "Action",
        field: 'Action',
        resizable: true,
        cellRenderer: function(params) {
                // Display the image
                /* This is a function that will display the image of the species. */
                let link = `<form method="post" action="delete/deleteEspece.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value=${params.value}/>
                    </form>`;
                return link;
            }
      },
    ];

    // specify the data
    var rowData = [];
    esp.forEach(espece => {
      rowData.push({
        num: espece.Numero,
        name: espece.NomEspece,
        TypeUn: espece.NomType,
        TypeDeux: espece.TypeEspece2,
        Zone: espece.NomZone,
        img: espece.Sprite,
        Action: espece.Numero
      })
    });

    // let the grid know which columns and what data to use
    var gridOptions = {
      defaultColDef: {
        sortable: true,
        cellStyle: {fontSize: '22px', textAlign: 'center'}
    },
      columnDefs: columnDefs,
      rowData: rowData,
      rowHeight: 100,
    };

    // setup the grid after the page has finished loading
    document.addEventListener('DOMContentLoaded', function() {
      var gridDiv = document.querySelector('#myGrid');
      new agGrid.Grid(gridDiv, gridOptions);
      gridOptions.api.sizeColumnsToFit();
    });
  </script>
  <button id="openModal"> Ajouter une espèce</button>
    <div id="mydialog">
      <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
        <h1 id="modal-heading">Ajouter une Espèce</h1>
        <form action="./add/add-espece.php" method="post">
          <label>Numéro : <input type="number" id="number" name="number" min=1 required><br></label>
          <label>Nom : <input type="text" id="name" name="name" required><br></label>
          <label>Type : <select name="type" id="type" required>
              <option value="">--Choisissez--</option>
              <?php include "./search/searchType.php" ?>
            </select><br> </label>
          <label>Type 2 : <select name="type-deux" id="type-deux">
              <option value=null>--Choisissez--</option>
              <?php include "./search/searchType.php" ?>
            </select><br> </label>
          <label>Zone : <select name="zone" id="zone" required>
              <option value="">--Choisissez--</option>
              <?php include "./search/searchZone.php" ?>
            </select> <br></label>
          <input type="submit" value="valider">
        </form>
        <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;" /></button>
      </dialog>
    </div>
  <script type="text/javascript" src="./js/modal.js"></script>
  <?php include "footer.php" ?>
</body>

</html>