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
  $imagen_portada = $_POST['imagen_portada'];
  $ano_publicacion = $_POST['ano_publicacion'];
  $idartista = $_POST['idartistas'];
  $resultado = $mysqli->query("SELECT MAX(id_album) as maximo FROM album");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;
  $cadenaSQL = "INSERT INTO album(id_album,imagen_portada,titulo,ano_publicacion,id_artista)
              VALUES ('$newId','$imagen_portada','$titulo','$ano_publicacion','$idartista')";
  $mysqli->query($cadenaSQL);
  header("Location: Perfil_Artista.php?idartistas=". $idartista);
$mysqli->close();
?>
</body>
</html>
