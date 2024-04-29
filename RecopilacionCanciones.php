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


    $idrecopilacion = $_GET['idrecopilacion'];
    $nombre = $_GET['nombre'];
    echo "<table style='width:100%'>";
    echo "<p style='font-size:30px; '><b>Recopilacion de Canciones</b></p>";
    echo "<p style='font-size:20px; '><b>". $nombre ."</b></p>";

    $canciones = "SELECT *,can.titulo as titulocancion FROM cancion as can INNER JOIN recopilacion_canciones_tiene_cancion as reco INNER JOIN album as alb WHERE
    reco.id_recopilacion_canciones='$idrecopilacion'
    and can.id_cancion = reco.id_cancion and can.id_album = alb.id_album";
    $resultado = $mysqli->query($canciones);

    while ($fila = $resultado->fetch_object()){
       echo "<tr>";
       echo "<td><img src=" . $fila->imagen_portada . " width='40' height='40'/></td>";
       echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila->id_cancion . "'>" . $fila->titulocancion . " </a></td>";

       echo "<td><b>" . $fila->duracion_min . ":" . $fila->duracion_seg . "</b></td>";

       echo "</tr>";

     }
     echo "</table>";




$mysqli->close();
?>
</body>
</html>
