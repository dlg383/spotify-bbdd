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
  $idpodcast = $_GET['idpodcast'];
  $podcast = "SELECT * FROM podcast WHERE id_podcast='$idpodcast'";
	$resultado = $mysqli->query($podcast);

		$fila = $resultado->fetch_object();
    echo "<br/>";
    echo "<br/>";
    echo "<div>";
    echo "<img src=" . $fila->enlace_imagen ." width='100%' height='500'/>";
	echo "<p style='font-size:50px; '><b>" . $fila->titulo .  "</b></p>";
	echo "<p><b> Descripción: " . $fila->informacion .  "</b></p>";
    echo "<p><b> Fecha de Creación: " . $fila->fecha_creacion .  "</b></p>";
    echo "<p><b> Número de reproducciones: " . $fila->num_reproducciones .  "</b></p>";

		$tematica = "SELECT * FROM tematica WHERE id_tematica='$fila->id_tematica'";
		$resultadot = $mysqli->query($tematica);
	  $filat = $resultadot->fetch_object();
		echo "<p><b> Temática: " . $filat->nombre .  "</b></p>";


		$seguimiento = "SELECT * FROM usuario_sigue_podcast WHERE id_podcast='$idpodcast' and id_usuario='$idusuarios'";
		$seguido = $mysqli->query($seguimiento);
		if ($seguido->num_rows==0){
		echo "<a href='ScriptSeguimiento.php?usuario=" . $idusuarios . "&podcast=" . $idpodcast . "' class='menu'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Seguir</button></a><br/>";
	  }

		echo "</div>";



  $episodios = "SELECT *, epi.descripcion as descrip FROM episodio as epi INNER JOIN podcast as pod WHERE pod.id_podcast = '$idpodcast'
  and epi.id_podcast = pod.id_podcast ORDER BY epi.num_reproducciones";
  $resultado2 = $mysqli->query($episodios);
  $count = 1;
  if ($resultado2->num_rows>0){
		echo "<hr>";
    echo "<p style='font-size:30px; '><b>Episodios Más Escuchadas</b></p>";
	  echo "<table style='width:100%'>";
    while ($fila2 = $resultado2->fetch_object() and $count<=5) {
		echo "<tr>";
		echo "<td>". $count . ".</td>";
		echo "<td><img src=" . $fila2->enlace_imagen . " width='40' height='40'/></td>";
		echo "<td><a class='menu' href='Pagina_Episodio.php?idepisodio=" . $fila2->id_episodio . "'>" . $fila2->descripcion . " </a></td>";
		echo "<td><b>" . $fila2->duracion . "</b></td>";
		echo "</tr>";
    $count = $count +1;
	}
	echo "<table>";
  }

  $recopilaciones = "SELECT * FROM recopilacion_episodios as rec  WHERE EXISTS (SELECT * FROM recopilacion_episodios_tiene_episodio as repi
    INNER JOIN episodio as epi
    INNER JOIN podcast as pod
    WHERE pod.id_podcast = '$idpodcast'
    and epi.id_podcast = pod.id_podcast
    and repi.id_episodio = epi.id_episodio
    and repi.id_recopilacion_episodios = rec.id_recopilacion_episodios)";

  $resultado4 = $mysqli->query($recopilaciones);
  if ($resultado4->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Recopilaciones en las que aparece</b></p>";
    while ($fila4 = $resultado4->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
    echo "<a class='menu' href='RecopilacionEpisodios.php?idrecopilacion=" . $fila4->id_recopilacion_episodios .  "&nombre=" . $fila4->nombre . "'> <img src=" . $fila4->imagen ." width='200' height='200'/></a>";
	 	echo "<p><b>" . $fila4->nombre .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


  $listas = "SELECT * FROM lista_reproduccion_episodios as rec  WHERE EXISTS (SELECT * FROM lista_reproduccion_episodios_tiene_episodio as repi
    INNER JOIN episodio as epi
    INNER JOIN podcast as pod
    WHERE pod.id_podcast = '$idpodcast'
    and epi.id_podcast = pod.id_podcast
    and repi.id_episodio = epi.id_episodio
    and repi.id_lista_rep_episodios = rec.id_lista_rep_episodios)";

  $resultado5 = $mysqli->query($listas);
  if ($resultado5->num_rows>0){
		echo "<hr>";
	  echo "<div>";
	  echo "<p style='font-size:30px; '><b>Listas de reproducción en las que aparece</b></p>";
    while ($fila5 = $resultado5->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='ListaReproduccionEpisodios.php?idlista=" . $fila5->id_lista_rep_episodios . "&nombre=". $fila5->nombre ."&publica=". $fila5->publica . "'>
														 <p>" . $fila5->nombre .  "</p></a>";
    echo "</div>";
	}
	echo "<div>";
  }


  $seguidores = "SELECT * FROM usuario as usu INNER JOIN usuario_sigue_podcast as seg WHERE seg.id_usuario = usu.id_usuario and seg.id_podcast='$idpodcast'";

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
