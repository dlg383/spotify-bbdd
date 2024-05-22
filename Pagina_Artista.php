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
  $idusuarios = $_SESSION['id'];
	$idartistas = $_GET['idartistas'];
  $artista = "SELECT * FROM artista WHERE id_artistas='$idartistas'";
	$resultado = $mysqli->query($artista);

		$fila = $resultado->fetch_object();
    echo "<br/>";
    echo "<br/>";
    echo "<div>";
    echo "<img src=" . $fila->imagen ." width='100%' height='500'/>";
	 	echo "<p style='font-size:50px; '><b>" . $fila->nombre .  "</b></p>";
		echo "<p><b> Descripción: " . $fila->descripcion .  "</b></p>";
    echo "<p><b> Número de reproducciones: " . $fila->num_reproducciones .  "</b></p>";

		$tematica = "SELECT * FROM tematica WHERE id_tematica='$fila->id_tematica'";
		$resultadot = $mysqli->query($tematica);
	  $filat = $resultadot->fetch_object();
		echo "<p><b> Temática: " . $filat->nombre .  "</b></p>";


		$seguimiento = "SELECT * FROM usuario_sigue_artista WHERE id_artistas='$idartistas' and id_usuario='$idusuarios'";
		$seguido = $mysqli->query($seguimiento);
		if ($seguido->num_rows==0){
		echo "<a href='ScriptSeguimientoArtista.php?usuario=" . $idusuarios . "&artista=" . $idartistas . "' class='menu'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Seguir</button></a><br/>";
	  }

		echo "</div>";



  $canciones = "SELECT *, can.titulo as titulocancion FROM cancion as can INNER JOIN album as alb WHERE alb.id_artista = '$idartistas'
  and can.id_album = alb.id_album ORDER BY can.num_reproducciones DESC";
  $resultado2 = $mysqli->query($canciones);
  $count = 1;
  if ($resultado2->num_rows>0){
		echo "<hr>";
    echo "<p style='font-size:30px; '><b>Canciones Más Escuchadas</b></p>";
	  echo "<table style='width:100%'>";
    while ($fila2 = $resultado2->fetch_object() and $count<=5) {
		echo "<tr>";
		echo "<td>". $count . ".</td>";
		echo "<td><img src=" . $fila2->imagen_portada . " width='40' height='40'/></td>";
		echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila2->id_cancion . "'>" . $fila2->titulocancion . " </a></td>";
		echo "<td><b>" . $fila2->duracion_min . ":" . $fila2->duracion_seg . "</b></td>";
		echo "</tr>";
    $count = $count +1;
	}
	echo "<table>";
  }


  $albumes = "SELECT * FROM album WHERE id_artista = '$idartistas'";
  $resultado3 = $mysqli->query($albumes);
  if ($resultado3->num_rows>0){
		echo "<hr>";
		echo "<div>";
	  echo "<p style='font-size:30px; '><b>Álbumes</b></p>";
    while ($fila3 = $resultado3->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='Pagina_Album.php?idalbumes=" . $fila3->id_album . "'> <img src=" . $fila3->imagen_portada ." width='200' height='200'/></a>";
	 	echo "<p><b>" . $fila3->titulo .  "</b></p>";
		echo "<p><b> Año de Publicación: " . $fila3->ano_publicacion .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


  $recopilaciones = "SELECT * FROM recopilacion_canciones as rec  WHERE EXISTS (SELECT * FROM recopilacion_canciones_tiene_cancion as rcan
    INNER JOIN cancion as can
    INNER JOIN album as alb
    INNER JOIN artista as art
    WHERE art.id_artistas = '$idartistas'
    and alb.id_artista = art.id_artistas
    and can.id_album = alb.id_album
    and rcan.id_cancion = can.id_cancion
    and rcan.id_recopilacion_canciones = rec.id_recopilacion_canciones)";

  $resultado4 = $mysqli->query($recopilaciones);
  if ($resultado4->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Recopilaciones en las que aparece</b></p>";
    while ($fila4 = $resultado4->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
    echo "<a class='menu' href='RecopilacionCanciones.php?idrecopilacion=" . $fila4->id_recopilacion_canciones .  "&nombre=" . $fila4->nombre . "'> <img src=" . $fila4->imagen ." width='200' height='200'/></a>";
	 	echo "<p><b>" . $fila4->nombre .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


  $listas = "SELECT * FROM lista_reproduccion_canciones as rec  WHERE EXISTS (SELECT * FROM lista_reproduccion_canciones_tiene_cancion as rcan
    INNER JOIN cancion as can
    INNER JOIN album as alb
    INNER JOIN artista as art
    WHERE art.id_artistas = '$idartistas'
    and alb.id_artista = art.id_artistas
    and can.id_album = alb.id_album
    and rcan.id_cancion = can.id_cancion
    and rcan.id_lista_rep_canciones = rec.id_lista_rep_canciones)";

  $resultado5 = $mysqli->query($listas);
  if ($resultado5->num_rows>0){
		echo "<hr>";
	  echo "<div>";
	  echo "<p style='font-size:30px; '><b>Listas de reproducción en las que aparece</b></p>";
    while ($fila5 = $resultado5->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='ListaReproduccionCanciones.php?idlista=" . $fila5->id_lista_rep_canciones . "&nombre=". $fila5->nombre ."&publica=". $fila5->publica . "'>
														 <p>" . $fila5->nombre .  "</p></a>";
    echo "</div>";
	}
	echo "<div>";
  }


  $seguidores = "SELECT * FROM usuario as usu INNER JOIN usuario_sigue_artista as seg WHERE seg.id_usuario = usu.id_usuario and seg.id_artistas='$idartistas'";

  $resultado6 = $mysqli->query($seguidores);
  if ($resultado6->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Usuarios que lo siguen</b></p>";
    while ($fila6 = $resultado6->fetch_object()) {
      echo "<div width='100%''>";
      echo "<img src=" . $fila6->imagen ."  class='avatar'/>";
  		echo "<br/>";
  	 	echo "<p><b>" . $fila6->nick .  "</b></p>";
      echo "</div>";
  }
  echo "<div>";
}


$mysqli->close();
?>
</body>
</html>
