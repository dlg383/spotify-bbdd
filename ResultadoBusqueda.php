<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$busqueda = $_POST['busqueda'];

	$bartistas = "SELECT * FROM artista WHERE nombre LIKE '%$busqueda%'";
	$rartistas = $mysqli->query($bartistas);
	if ($rartistas->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Artistas</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rartistas->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->imagen . " width='40' height='40'/></td>";
			echo "<td><a class='menu' href='Pagina_Artista.php?idartistas=" . $fila->id_artistas . "'><b>" . $fila->nombre . "</b></a></td>";
		}
		echo "</table>";
	}
	$bcanciones = "SELECT * FROM cancion WHERE titulo LIKE '%$busqueda%'";
	$rcanciones = $mysqli->query($bcanciones);
	if ($rcanciones->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Canciones</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rcanciones->fetch_object()) {
			echo "<tr>";
				echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila->id_cancion . "'><b>" . $fila->titulo . "</b></a></td>";

		}
		echo "</table>";
	}
	$balbumes = "SELECT * FROM album WHERE titulo LIKE '%$busqueda%'";
	$ralbumes = $mysqli->query($balbumes);
	if ($ralbumes->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Albumes</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $ralbumes->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->imagen_portada . " width='40' height='40'/></td>";
			echo "<td><a class='menu' href='Pagina_Album.php?idalbumes=" . $fila->id_album . "'><b>" . $fila->titulo . "</b></a></td>";

		}
		echo "</table>";
	}

	$bpodcast = "SELECT * FROM podcast WHERE titulo LIKE '%$busqueda%'";
	$rpodcast = $mysqli->query($bpodcast);
	if ($rpodcast->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Podcast</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rpodcast->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->enlace_imagen . " width='40' height='40'/></td>";
			echo "<td><a class='menu' href='Pagina_Podcast.php?idpodcast=" . $fila->id_podcast . "'><b>" . $fila->titulo . "</b></a></td>";
		}
		echo "</table>";
	}

	$bepisodio = "SELECT * FROM episodio WHERE descripcion LIKE '%$busqueda%'";
	$repisodio = $mysqli->query($bepisodio);
	if ($repisodio->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Episodios</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $repisodio->fetch_object()) {
			echo "<tr>";
			echo "<td><a class='menu' href='Pagina_Episodio.php?idepisodio=" . $fila->id_episodio . "'><b>" . $fila->descripcion . "</b></a></td>";
		}
		echo "</table>";
	}

	$blistasdereproduccioncanciones = "SELECT * FROM lista_reproduccion_canciones WHERE nombre LIKE '%$busqueda%' and publica";
	$rlistasdereproduccioncanciones = $mysqli->query($blistasdereproduccioncanciones);
	if ($rlistasdereproduccioncanciones->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Listas de reproducción de canciones</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rlistasdereproduccioncanciones->fetch_object()) {
			echo "<tr>";
			echo "<td><a class='menu' href='ListaReproduccionCanciones.php?idlista=" .
			$fila->id_lista_rep_canciones . "&nombre=" . $fila->nombre . "&publica=" . $fila->publica . "'><b>" . $fila->nombre . "</b></a></td>";

		}
		echo "</table>";
	}

	$blistasdereproduccionepisodios = "SELECT * FROM lista_reproduccion_episodios WHERE nombre LIKE '%$busqueda%' and publica";
	$rlistasdereproduccionepisodios = $mysqli->query($blistasdereproduccionepisodios);
	if ($rlistasdereproduccionepisodios->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Listas de reproducción de episodios</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rlistasdereproduccionepisodios->fetch_object()) {
			echo "<tr>";
			echo "<td><a class='menu' href='ListaReproduccionEpisodios.php?idlista=" .
			$fila->id_lista_rep_episodios . "&nombre=" . $fila->nombre . "&publica=" . $fila->publica . "'><b>" . $fila->nombre . "</b></a></td>";
		}
		echo "</table>";
	}

	$brecopilacioncanciones = "SELECT * FROM recopilacion_canciones WHERE nombre LIKE '%$busqueda%'";
	$rrecopilacioncanciones = $mysqli->query($brecopilacioncanciones);
	if ($rrecopilacioncanciones->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Recopilaciones de canciones</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rrecopilacioncanciones->fetch_object()) {
			echo "<tr>";
			echo "<td><a class='menu' href='RecopilacionCanciones.php?idrecopilacion=" .
			$fila->id_recopilacion_canciones . "&nombre=" . $fila->nombre . "'><b>" . $fila->nombre . "</b></a></td>";
		}
		echo "</table>";
	}

	$brecopilacionepisodios = "SELECT * FROM recopilacion_episodios WHERE nombre LIKE '%$busqueda%'";
	$rrecopilacionepisodios = $mysqli->query($brecopilacionepisodios);
	if ($rrecopilacionepisodios->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Recopilaciones de episodios</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rrecopilacionepisodios->fetch_object()) {
			echo "<tr>";
			echo "<td><a class='menu' href='RecopilacionEpisodios.php?idrecopilacion=" .
			$fila->id_recopilacion_episodios . "&nombre=" . $fila->nombre . "'><b>" . $fila->nombre . "</b></a></td>";
		}
		echo "</table>";
	}

	$busuarios = "SELECT * FROM usuario WHERE nick LIKE '%$busqueda%'";
	$rusuarios = $mysqli->query($busuarios);
	if ($rusuarios->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Usuarios</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rusuarios->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->imagen ."  width='40' height='40'/></td>";
			echo "<td><b>" . $fila->nick . "</b></td>";

		}
		echo "</table>";
	}

$mysqli->close();
?>
</body>
</html>
