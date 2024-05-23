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
  echo "<b> Media de me gustas por Podcast </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Nombre del Podcast </b></td>";
  echo "<td><b> Media de Me Gustas </b></td>";
  echo "</tr>";
  $media = "SELECT pod.id_podcast, pod.titulo, ROUND(AVG(mg.total_mg), 2) as media_mg
            FROM (
                SELECT epi.id_podcast, epi.id_episodio, COUNT(mg.id_usuario) as total_mg
                FROM episodio as epi
                INNER JOIN usuario_likes_episodio as mg ON epi.id_episodio = mg.id_episodio
                GROUP BY epi.id_podcast, epi.id_episodio
            ) as mg
            INNER JOIN podcast as pod ON mg.id_podcast = pod.id_podcast
            GROUP BY pod.id_podcast, pod.titulo;";
  $resultado = $mysqli->query($media);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->titulo . "</b></td>";
     echo "<td><b>" . $fila->media_mg . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";
