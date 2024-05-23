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
  echo "<b> Media de me gustas por Artistas </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Número de Artistas </b></td>";
  echo "<td><b> Temática </b></td>";
  echo "</tr>";
  $media = "SELECT art.id_artistas, art.nombre, ROUND(AVG(mg.total_mg),2) as media_mg
            FROM (
                SELECT can.id_cancion, alb.id_artista, COUNT(mg.id_cancion) as total_mg
                FROM cancion as can
                INNER JOIN usuario_likes_cancion as mg ON can.id_cancion = mg.id_cancion
                INNER JOIN album as alb ON can.id_album = alb.id_album
                GROUP BY can.id_cancion, alb.id_artista
            ) as mg
            INNER JOIN artista as art ON mg.id_artista = art.id_artistas
            GROUP BY art.id_artistas, art.nombre;";
  $resultado = $mysqli->query($media);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->nombre . "</b></td>";
     echo "<td><b>" . $fila->media_mg . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";
