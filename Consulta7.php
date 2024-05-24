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
  echo "<b> Número de apariciones de canciones en listas y recopilatorios </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Nombre de la cancion </b></td>";
  echo "<td><b> Número de apariciones en listas</b></td>";
  echo "<td><b> Número de apariciones en recopilaciones</b></td>";
  echo "</tr>";
  $consulta =  "SELECT can.titulo, num_apariciones_lista.num_apariciones AS num_apariciones_lista, num_apariciones_rec.num_apariciones AS num_apariciones_rec
                FROM (
                      SELECT c.titulo, c.id_cancion, COUNT(lista.id_cancion) as num_apariciones
                      FROM lista_reproduccion_canciones_tiene_cancion lista
                      RIGHT JOIN cancion c ON lista.id_cancion = c.id_cancion
                      GROUP BY c.id_cancion) AS num_apariciones_lista
                JOIN (
                      SELECT c.titulo, c.id_cancion, COUNT(rec.id_cancion) as num_apariciones
                      FROM recopilacion_canciones_tiene_cancion rec
                      RIGHT JOIN cancion c ON rec.id_cancion = c.id_cancion
                      GROUP BY c.id_cancion) AS num_apariciones_rec 
                      ON num_apariciones_lista.id_cancion = num_apariciones_rec.id_cancion
                JOIN cancion can ON num_apariciones_rec.id_cancion = can.id_cancion";

  $resultado = $mysqli->query($consulta);

   while ($fila = $resultado->fetch_object()){
    echo "<tr>";
    echo "<td><b>" . $fila->titulo . "</b></td>";
    echo "<td><b>" . $fila->num_apariciones_lista . "</b></td>";
    echo "<td><b>" . $fila->num_apariciones_rec . "</b></td>";
    echo "</tr>";
  }
   echo "</table>";
