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

	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	$usuario = "SELECT * FROM usuario WHERE login='$login' AND password='$password'";
	$resultado = $mysqli->query($usuario);

		$fila = $resultado->fetch_object();
		echo "<br/>";
		echo "<br/>";
    echo "<div width='100%''>";
    echo "<img src=" . $fila->imagen ."  class='avatar'/>";
		echo "<br/>";
		echo "<br/>";
	 	echo "<p><b> Perfil de " . $fila->nick .  "</b></p>";
		echo "<p><b> Nombre: " . $fila->nombre .  "</b></p>";
    echo "</div>";




 $usuario = $fila->id_usuario;
 $artistas ="SELECT * FROM artista INNER JOIN usuario_sigue_artista as aseg WHERE
 aseg.id_usuario=$usuario AND
 aseg.id_artistas = artista.id_artistas";
 $resultado2 = $mysqli->query($artistas);
 if ($resultado2->num_rows>0){
	 	echo "<hr>";
	 echo "<div>";
	 echo "<p style='font-size:30px; '><b>Artistas que sigues</b></p>";
		while ($fila2 = $resultado2->fetch_object()) {
			echo "<div class='column' style='margin: 20pt;'>";
			echo "<a class='menu' href='Pagina_Artista.php?idartistas=" . $fila2->id_artistas . "'> <img width='200' height='200' src='". $fila2->imagen ."'></img></a>";
			echo "<p>" . $fila2->nombre . "</p>";
			echo "</div>";
		}
	}
	echo "</div>";


	$usuario = $fila->id_usuario;
  $podcasts ="SELECT * FROM podcast INNER JOIN usuario_sigue_podcast as pseg
	WHERE pseg.id_usuario=$usuario AND
  pseg.id_podcast = podcast.id_podcast";
  $resultado3 = $mysqli->query($podcasts);
  if ($resultado3->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Podcasts que sigues</b></p>";
 		while ($fila3 = $resultado3->fetch_object()) {
			echo "<div class='column' style='margin: 20pt;'>";
			echo "<a class='menu' href='Pagina_Podcast.php?idpodcast=" . $fila3->id_podcast . "'> <img width='200' height='200' src='". $fila3->enlace_imagen ."'></img></a>";
			echo "<p>" . $fila3->titulo . "</p>";
			echo "</div>";
 		}
 	}
	echo "</div>";


	$usuario = $fila->id_usuario;
  $canciones ="SELECT can.titulo, can.id_cancion, al.imagen_portada 
				FROM (
					SELECT * FROM usuario_likes_cancion as mg where mg.id_usuario = 0
				) as mg
				INNER JOIN cancion as can INNER JOIN album as al 
				WHERE mg.id_cancion = can.id_cancion 
				AND can.id_album = al.id_album";
  $resultado4 = $mysqli->query($canciones);
  if ($resultado4->num_rows>0){
		echo "<hr>";
  	echo "<div>";
  	echo "<p style='font-size:30px; '><b>Canciones que te gustan</b></p>";
 	 while ($fila4 = $resultado4->fetch_object()) {
		echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila4->id_cancion . "'> <img src=" . $fila4->imagen_portada . " width='200' height='200'/></a>";
 		echo "<p>" . $fila4->titulo . "</p>";
 		echo "</div>";
 	 }
  }
	echo "</div>";


	$usuario = $fila->id_usuario;
  $episodios ="SELECT * FROM episodio as epi INNER JOIN usuario_likes_episodio as gep INNER JOIN podcast as pod WHERE gep.id_usuario=$usuario
	and epi.id_episodio = gep.id_episodio and pod.id_podcast = epi.id_podcast";
  $resultado5 = $mysqli->query($episodios);
  if ($resultado5->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Episodios que te gustan</b></p>";
 		while ($fila5 = $resultado5->fetch_object()) {
			echo "<div class='column' style='margin: 20pt;'>";
			echo "<a class='menu' href='Pagina_Episodio.php?idepisodio=" . $fila5->id_episodio . "'> <img width='200' height='200' src='". $fila5->enlace_imagen ."'></img></a>";
	 		echo "<p style='max-width: 150pt; overflow: hidden;'>" . $fila5->descripcion . "</p>";
	 		echo "</div>";
 		}
 	}
	echo "</div>";
$mysqli->close();
?>
</body>
</html>
