<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/monsite.css" />
  <meta charset="utf-8" />
  <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.js"></script>
  <title>Liste des proprietaires</title>
</head>

<body>
  <?php include "topnav.php" ?>
  <div class="listeEspece">
    <h2>Liste des proprietaires</h2>
    <div id="myGrid" style="width: 100em; position: absolute;left: 50px;border-radius: 15px;overflow: auto;font-size: large;" class="ag-theme-alpine"></div>
  </div>
  <script type="text/javascript">
    <?php
    include "connect.php";
    $requete = "select * from PROPRIETAIRE";
    /* Si l'execution est reussie... */
    if ($res = $dbh->query($requete))
      /* ... on récupère un tableau stockant le résultat */
      $owners =  $res->fetchAll();
    /*liberation de l'objet requete:*/
    $res->closeCursor();
    /*fermeture de la connexion avec la base*/
    $dbh = null;
    ?>
    var owners = <?php echo json_encode($owners); ?>;

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
        headerName: "Jouable",
        field: 'playable',
        filter: 'agTextColumnFilter',
        resizable: true,
      },
      {
        headerName: "Action",
        field: 'Action',
        resizable: true,
        sortable: false,
        cellRenderer: function(params) {
          // Display the image
          /* This is a function that will display the image of the species. */
          let link = `<form method="post" action="delete/deleteProprietaire.php">
                      <button type="submit" name="btnEnvoiForm" title="Envoyer"><h2 style="color:black">Supprimer</h2></button>
                      <input type="hidden" name="id" value=${params.value}/>
                    </form>`
          return link;
        }
      },
    ];

    // specify the data
    var rowData = [];
    owners.forEach(proprio => {
      rowData.push({
        name: proprio.NomProprietaire,
        playable: proprio.IsJouable == 1 ? '✓' : 'X',
        Action: proprio.IdProprietaire
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
    <button id="openModal">Ajouter un propriétaire</button>
  </div>
  <div id="mydialog">
    <dialog open class="ModalAddSpecies" role="dialog" aria-modal="true" aria-labelledby="modal-heading">
      <h1 id="modal-heading">Ajouter un Proprietaire</h1>
      <form action="./add/add-proprietaire.php" method="post">
        <label>Nom : <input type="text" id="name" name="name" required><br></label>
        <label>Jouable? <input type="checkbox" id="Jouable" name="Jouable"></label><br>
        <input id="validation" type="submit" value="valider">
      </form>
      <button onclick="document.getElementById('mydialog').style.visibility='hidden'" style="position: inherit;top: -4px;left: 80%;border: none;background: transparent;"><img src="assets/376.png" alt="close" style="width: 60px; height: 60px;" /></button>
    </dialog>
  </div>
  <?php include "footer.php" ?>
  <script type="text/javascript" src="./js/modal.js"></script>
  
</body>

</html>