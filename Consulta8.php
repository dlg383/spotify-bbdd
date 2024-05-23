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
  echo "<tr><td><b> APARICIONES EN LISTAS</b></td><tr>";
  echo "<tr>";
  echo "<td><b> Descripción del episodio </b></td>";
  echo "<td><b> Número de apariciones en listas</b></td>";
  echo "</tr>";
  $lista = "SELECT cuenta.descripcion, COUNT(cuenta.id_lista_rep_episodios) as cont
            FROM (
                SELECT epi.id_episodio, epi.descripcion, lista.id_lista_rep_episodios
                FROM episodio as epi
                INNER JOIN lista_reproduccion_episodios_tiene_episodio as lista
                WHERE epi.id_episodio = lista.id_episodio
            ) as cuenta
            GROUP BY cuenta.descripcion;";

  $resultado = $mysqli->query($lista);

   while ($fila = $resultado->fetch_object()){
    echo "<tr>";
    echo "<td style='max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'><b>" . $fila->descripcion . "</b></td>";
    echo "<td><b style='margin-left: 30px;'>" . $fila->cont . "</b></td>";
    echo "</tr>";
  }

  echo "<tr><td><b> APARICIONES EN RECOPILACIONES</b></td><tr>";
   echo "<tr>";
   echo "<td><b> Descripción del episodio </b></td>";
   echo "<td><b> Número de apariciones en recopilaciones</b></td>";
   echo "</tr>";

   $reco = "SELECT cuenta.descripcion, COUNT(cuenta.id_recopilacion_episodios) as cont
            FROM (
                SELECT epi.id_episodio, epi.descripcion, reco.id_recopilacion_episodios
                FROM episodio as epi
                INNER JOIN recopilacion_episodios_tiene_episodio as reco
                WHERE epi.id_episodio = reco.id_episodio
            ) as cuenta
            GROUP BY cuenta.descripcion;";
    
    $resultado2 = $mysqli->query($reco);

  while ($fila2 = $resultado2->fetch_object()){
     echo "<tr>";
     echo "<td style='max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'><b>" . $fila2->descripcion . "</b></td>";
     echo "<td><b  style='margin-left: 30px;'>" . $fila2->cont . "</b></td>";
     echo "</tr>";
   }

   echo "</table>";
