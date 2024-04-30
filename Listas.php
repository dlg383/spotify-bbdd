<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="micss.css">
</head>
<body>
	<?php
	include_once ('Conexion.php');
  session_start();

	$id = $_SESSION['id'];


	$listascanciones = "SELECT * FROM lista_reproduccion_canciones WHERE id_usuario='$id'";
	$resultado = $mysqli->query($listascanciones);
	if ($resultado->num_rows>0){
		echo "<hr>";
  echo "<div>";
  echo "<p style='font-size:30px; '><b> Tus listas de reproducción de canciones </b></p>";
  while ($fila = $resultado->fetch_object()){
		echo "<div class='row'>";
		echo "<a class='menu' href='ListaReproduccionCanciones.php?idlista=" . $fila->id_lista_rep_canciones . "&nombre=". $fila->nombre ."&publica=". $fila->publica . "'>
			 												<p>" . $fila->nombre .  "</p></a>";
		echo "</div>";
  }
	}

	echo "</div>";


  $listasepisodios = "SELECT * FROM lista_reproduccion_episodios WHERE id_usuario='$id'";
	$resultado2 = $mysqli->query($listasepisodios);
	if ($resultado2->num_rows>0){
		echo "<hr>";
  echo "<div>";
  echo "<p style='font-size:30px; '><b> Tus listas de reproducción de episodios </b></p>";
  while ($fila2 = $resultado2->fetch_object()){
		echo "<div class='row'>";
	  echo "<a class='menu' href='ListaReproduccionEpisodios.php?idlista=" . $fila2->id_lista_rep_episodios . "&nombre=". $fila2->nombre ."&publica=". $fila2->publica . "'>
															<p>" . $fila2->nombre .  "</p></a>";
		echo "</div>";
  }
 }


	echo "<hr>";
	echo "<a class='menu' href='ScriptNuevaListaCanciones.php?&usuario=". $id . "'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nueva Lista de Reproducción de Canciones</button></a>";
  echo "<a class='menu' href='ScriptNuevaListaEpisodios.php?&usuario=". $id . "'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nueva Lista de Reproducción de Episodios</button></a>";
  echo "</div>";


$mysqli->close();
?>
</body>
</html>
