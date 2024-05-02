<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$titulo = $_POST['titulo'];
  $enlaceaspotify = $_POST['enlaceaspotify'];
  $minutos = $_POST['minutos'];
  $segundos = $_POST['segundos'];
  $idalbumes = $_POST['idalbumes'];
  $resultado = $mysqli->query("SELECT MAX(id_cancion) as maximo FROM cancion");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;
  $cadenaSQL = "INSERT INTO cancion(id_cancion,titulo,enlace_spotify,num_reproducciones,duracion_min,duracion_seg,id_album)
              VALUES ('$newId','$titulo','$enlaceaspotify','0','$minutos','$segundos','$idalbumes')";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Album.php?idalbumes=". $idalbumes);
$mysqli->close();
?>
</body>
</html>
