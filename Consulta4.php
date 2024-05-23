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
  echo "<b> Podcasts más seguidos </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Podcast </b></td>";
  echo "<td><b> Número de seguidores </b></td>";
  echo "</tr>";
  $tematicas = "SELECT pod.titulo, COUNT(*) as num_seguidores
  FROM lopezgavriloaie.podcast AS pod
  JOIN lopezgavriloaie.usuario_sigue_podcast AS sig ON pod.id_podcast = sig.id_podcast
  GROUP BY sig.id_podcast
  ORDER BY num_seguidores DESC
  LIMIT 3";
  $resultado = $mysqli->query($tematicas);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->titulo . "</b></td>";
     echo "<td><b>" . $fila->num_seguidores . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";
