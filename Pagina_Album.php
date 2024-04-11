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

  $idalbumes = $_GET['idalbumes'];

  $album = "SELECT * FROM albumes as alb INNER JOIN artistas as art WHERE idalbumes='$idalbumes' and alb.artistas_idartistas = art.idartistas";
	$resultado = $mysqli->query($album);

		$fila = $resultado->fetch_object();
    echo "<br/>";
    echo "<br/>";

    echo "<div>";
    echo "<img src=" . $fila->imagendeportada ." width='100%' height='500'/>";
	 	echo "<p style='font-size:50px; '><b>" . $fila->titulo .  "</b></p>";
    echo "<p><b> " . $fila->nombre .  "</b></p>";
    echo "<a class='menu' href='Pagina_Artista.php?idartistas=" . $fila->idartistas . "'> <img src=" . $fila->imagen ." width='10%' height='10%'/></a>";
		echo "<p><b> Año de Publicación: " . $fila->anodepublicacion .  "</b></p>";

		if ($_SESSION['type'] == 'artista'){
	  echo "<a href='NuevaCancion.php?idalbumes=". $fila->idalbumes . "' class='menu'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nueva Canción</button></a><br/>";
	  }
		echo "</div>";


  $listascanciones = "SELECT * FROM canciones WHERE albumes_idalbumes='$idalbumes'";
	$resultado2 = $mysqli->query($listascanciones);
  if ($resultado2->num_rows>0){
  echo "<hr/>";
  echo "<p style='font-size:30px; '><b> Canciones </b></p>";
  echo "<table style='width:100%'>";
  $count = 1;
  while ($fila2 = $resultado2->fetch_object()){
     echo "<tr>";
     echo "<td>". $count . ".</td>";
     echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila2->idcanciones . "'> <p><b>" . $fila2->titulo .  "</b></p></a></td>";
     echo "<td><b>" . $fila2->minutos .  ":" . $fila2->segundos .  "</b></td>";
     echo "</tr>";

     $count = $count +1;
    }
	}
	echo "</div>";

$mysqli->close();
?>
</body>
</html>
