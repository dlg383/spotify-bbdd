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

    $canciones = "SELECT *,epi.descripcion as descripcionepisodio FROM episodio as epi INNER JOIN lista_reproduccion_episodios_tiene_episodio as lista INNER JOIN podcast as pod WHERE
    lista.id_lista_rep_episodios='$idlista'
    and epi.id_episodio = lista.id_episodio and epi.id_podcast = pod.id_podcast";
    $resultado = $mysqli->query($canciones);

    while ($fila = $resultado->fetch_object()){
       echo "<tr style=''>";
       echo "<td><img src=" . $fila->enlace_imagen . " width='100' height='100'/></td>";
       echo "<td><a class='menu' href='Pagina_Episodio.php?idepisodio=" . $fila->id_episodio . "' style='display:block; width:80%; margin-left: 2em;'>" . $fila->descripcionepisodio . " </a></td>";

       echo "<td><b>" . $fila->duracion . "</b></td>";

       echo "</tr>";

     }
  echo "</table>";




$mysqli->close();
?>
</body>
</html>
