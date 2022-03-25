<?php
  $dsn = 'mysql:dbname=enaudy;host=localhost';
  $user = 'enaudy'/*A compléter*/;
  $pass = '9BPCJCQGHAWZ'/*A compléter*/;
  /* Creation de l'objet qui gere la connexion: */
  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>