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
  echo "<b> Número de apariciones de episodios en listas y recopilatorios </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Descripción del episodio </b></td>";
  echo "<td><b> Número de apariciones en listas</b></td>";
  echo "<td><b> Número de apariciones en recopilaciones</b></td>";
  echo "</tr>";
  $consulta =  "SELECT epis.descripcion, num_apariciones_lista.num_apariciones AS num_apariciones_lista, num_apariciones_rec.num_apariciones AS num_apariciones_rec
                FROM (SELECT ep.descripcion, ep.id_episodio, COUNT(lista.id_episodio) as num_apariciones
                      FROM lista_reproduccion_episodios_tiene_episodio lista
                      RIGHT JOIN episodio ep ON lista.id_episodio = ep.id_episodio
                      GROUP BY ep.id_episodio) AS num_apariciones_lista
                JOIN (
                      SELECT ep.descripcion, ep.id_episodio, COUNT(rec.id_episodio) as num_apariciones
                      FROM recopilacion_episodios_tiene_episodio rec
                      RIGHT JOIN episodio ep ON rec.id_episodio = ep.id_episodio
                      GROUP BY ep.id_episodio) AS num_apariciones_rec 
                      ON num_apariciones_lista.id_episodio = num_apariciones_rec.id_episodio
                JOIN episodio epis ON num_apariciones_rec.id_episodio = epis.id_episodio;";

  $resultado = $mysqli->query($consulta);

   while ($fila = $resultado->fetch_object()){
    echo "<tr>";
    echo "<td style='max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'><b>" . $fila->descripcion . "</b></td>";
    echo "<td><b style='margin-left: 30px;'>" . $fila->num_apariciones_lista . "</b></td>";
    echo "<td><b style='margin-left: 30px;'>" . $fila->num_apariciones_rec . "</b></td>";

    echo "</tr>";
  }

   echo "</table>";
