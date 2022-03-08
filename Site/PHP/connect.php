<?php
  $login = 'enaudy'/*A compléter*/;
  $db_pwd = '9BPCJCQGHAWZ'/*A compléter*/;
  /* Creation de l'objet qui gere la connexion: */
  $connection = new mysqli("vvv.enseirb-matmeca.fr", $login, $db_pwd, $login);
  if ($conn->connect_error) {
      echo("Connection failed");
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
?>