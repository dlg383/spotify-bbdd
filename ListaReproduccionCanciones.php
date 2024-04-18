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


    $idlista = $_GET['idlista'];
    $nombre = $_GET['nombre'];
    $publica = $_GET['publica'];
    echo "<table style='width:100%'>";
    if ($publica) { echo "<p style='font-size:30px; '><b>Lista pública de Reproducción</b></p>";} else {echo "<p style='font-size:30px; '><b>Lista privada de Reproducción</b></p>";}
    echo "<p style='font-size:20px; '><b>". $nombre ."</b></p>";

    $canciones = "SELECT *,can.titulo as titulocancion FROM cancion as can INNER JOIN lista_reproduccion_canciones_tiene_cancion as lista INNER JOIN album as alb WHERE
    lista.id_lista_rep_canciones='$idlista'
    and can.id_cancion = lista.id_cancion and can.id_album = alb.id_album";
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
