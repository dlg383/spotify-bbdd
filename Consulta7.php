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
  echo "<tr><td><b> APARICIONES EN LISTAS</b></td><tr>";
  echo "<tr>";
  echo "<td><b> Nombre de la cancion </b></td>";
  echo "<td><b> Número de apariciones en listas</b></td>";
  echo "</tr>";
  $lista = "SELECT cuenta.titulo, COUNT(cuenta.id_lista_rep_canciones) as cont
            FROM (
                SELECT can.id_cancion, can.titulo, lista.id_lista_rep_canciones
                FROM cancion as can
                INNER JOIN lista_reproduccion_canciones_tiene_cancion as lista
                WHERE can.id_cancion = lista.id_cancion
            ) as cuenta
            GROUP BY cuenta.titulo;";

  $resultado = $mysqli->query($lista);

   while ($fila = $resultado->fetch_object()){
    echo "<tr>";
    echo "<td><b>" . $fila->titulo . "</b></td>";
    echo "<td><b>" . $fila->cont . "</b></td>";
    echo "</tr>";
  }

  echo "<tr><td><b> APARICIONES EN RECOPILACIONES</b></td><tr>";
   echo "<tr>";
   echo "<td><b> Nombre de la cancion </b></td>";
   echo "<td><b> Número de apariciones en recopilaciones</b></td>";
   echo "</tr>";

   $reco = "SELECT cuenta.titulo, COUNT(cuenta.id_recopilacion_canciones) as cont
            FROM (
                SELECT can.id_cancion, can.titulo, reco.id_recopilacion_canciones
                FROM cancion as can
                INNER JOIN recopilacion_canciones_tiene_cancion as reco
                WHERE can.id_cancion = reco.id_cancion
            ) as cuenta
            GROUP BY cuenta.titulo;";
    
    $resultado2 = $mysqli->query($reco);

  while ($fila2 = $resultado2->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila2->titulo . "</b></td>";
     echo "<td><b>" . $fila2->cont . "</b></td>";
     echo "</tr>";
   }

   echo "</table>";
