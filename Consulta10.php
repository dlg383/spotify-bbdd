<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<link rel="stylesheet" href="micss.css">
</head>
<body>
	<?php
	include_once ('Conexion.php');
  session_start();
  echo "<b> Episodios que no Gustan </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Descripción del episodio </b></td>";
  echo "</tr>";
  $episodios = "SELECT epi.descripcion
                FROM episodio AS epi
                LEFT JOIN usuario_likes_episodio as mg 
                ON epi.id_episodio = mg.id_episodio
                WHERE mg.id_episodio IS NULL;";
  $resultado = $mysqli->query($episodios);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td style='max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'><b>" . $fila->descripcion . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";
