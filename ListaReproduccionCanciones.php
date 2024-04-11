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

    $canciones = "SELECT *,can.titulo as titulocancion FROM canciones as can INNER JOIN canciones_de_listas as lista INNER JOIN albumes as alb WHERE
    lista.listasdereproduccioncanciones_idlistasdereproduccioncanciones='$idlista'
    and can.idcanciones = lista.canciones_idcanciones and can.albumes_idalbumes = alb.idalbumes";
    $resultado = $mysqli->query($canciones);

    while ($fila = $resultado->fetch_object()){
       echo "<tr>";
       echo "<td><img src=" . $fila->imagendeportada . " width='40' height='40'/></td>";
       echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila->idcanciones . "'>" . $fila->titulocancion . " </a></td>";

       echo "<td><b>" . $fila->minutos . ":" . $fila->segundos . "</b></td>";

       echo "</tr>";

     }
     echo "</table>";




$mysqli->close();
?>
</body>
</html>
