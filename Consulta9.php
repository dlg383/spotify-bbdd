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
  echo "<b> Canciones que no Gustan </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Nombre de la canción </b></td>";
  echo "</tr>";
  $canciones = "SELECT can.titulo
                FROM cancion AS can
                LEFT JOIN usuario_likes_cancion as mg 
                ON can.id_cancion = mg.id_cancion
                WHERE mg.id_cancion IS NULL;";
  $resultado = $mysqli->query($canciones);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->titulo . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";
