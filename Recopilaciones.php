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
	include_once('Conexion.php');
	session_start();

	$id = $_SESSION['id'];


	$recopilacionescanciones = "SELECT * FROM recopilacion_canciones WHERE id_admin='$id'";
	$resultado = $mysqli->query($recopilacionescanciones);
	if ($resultado->num_rows > 0) {
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b> Tus recopilaciones de canciones </b></p>";
		while ($fila = $resultado->fetch_object()) {
			echo "<div class='row'>";
			echo "<a class='menu' href='RecopilacionCanciones.php?idrecopilacion=" . $fila->id_recopilacion_canciones . "&nombre=" . $fila->nombre . "'>
			 												<p>" . $fila->nombre .  "</p></a>";
			echo "</div>";
		}
	}

	echo "</div>";


	$recopilacionesepisodios = "SELECT * FROM recopilacion_episodios WHERE id_admin='$id'";
	$resultado2 = $mysqli->query($recopilacionesepisodios);
	if ($resultado2->num_rows > 0) {
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b> Tus recopilaciones de episodios </b></p>";
		while ($fila2 = $resultado2->fetch_object()) {
			echo "<div class='row'>";
			echo "<a class='menu' href='RecopilacionEpisodios.php?idrecopilacion=" . $fila2->id_recopilacion_episodios . "&nombre=" . $fila2->nombre . "'>
															<p>" . $fila2->nombre .  "</p></a>";
			echo "</div>";
		}
	}


	echo "<hr>";
	echo "<a class='menu' href='NuevaRecopilacionCanciones.php?&admin=" . $id . "'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nueva Recopilación de Canciones</button></a>";
	echo "<a class='menu' href='NuevaRecopilacionEpisodios.php?&admin=" . $id . "'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nueva Recopilación de Episodios</button></a>";
	echo "</div>";


	$mysqli->close();
	?>
</body>

</html>