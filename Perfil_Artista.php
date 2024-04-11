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

	$idartistas = $_SESSION['id'];
  $artista = "SELECT * FROM artistas WHERE idartistas='$idartistas'";
	$resultado = $mysqli->query($artista);

		$fila = $resultado->fetch_object();
    echo "<br/>";
    echo "<br/>";
    echo "<div>";
    echo "<img src=" . $fila->imagen ." width='100%' height='500'/>";
	 	echo "<p style='font-size:50px; '><b>" . $fila->nombre .  "</b></p>";
		echo "<p><b> Descripción: " . $fila->descripcion .  "</b></p>";
    echo "<p><b> Número de reproducciones: " . $fila->numerodereproducciones .  "</b></p>";

		$tematica = "SELECT * FROM tematica WHERE idtematica='$fila->tematica_idtematica'";
		$resultadot = $mysqli->query($tematica);
	  $filat = $resultadot->fetch_object();
		echo "<p><b> Temática: " . $filat->nombre .  "</b></p>";

    echo "<p><b> Ingresos Actuales </b></p>";
		$ingresos = "SELECT * FROM ingresos_artistas WHERE idartistas='$idartistas'";
		$resultadoi = $mysqli->query($ingresos);

		IF ($resultadoi->num_rows==0) {
	  echo "<p><b> Cantidad: 0 </b></p>";
		} ELSE
    {
	  $filai = $resultadoi->fetch_object();
		echo "<p><b> Fecha: " . $filai->fecha .  "</b></p>";
    echo "<p><b> Cantidad: " . $filai->cantidad .  "</b></p>";
	  }
    echo "</div>";



  $canciones = "SELECT *, can.titulo as titulocancion FROM canciones as can INNER JOIN albumes as alb WHERE alb.artistas_idartistas = '$idartistas'
  and can.albumes_idalbumes = alb.idalbumes ORDER BY can.numerodereproduciones";
  $resultado2 = $mysqli->query($canciones);
  $count = 1;
  if ($resultado2->num_rows>0){
		echo "<hr>";
    echo "<p style='font-size:30px; '><b>Canciones Más Escuchadas</b></p>";
	  echo "<table style='width:100%'>";
    while ($fila2 = $resultado2->fetch_object() and $count<=5) {
		echo "<tr>";
		echo "<td>". $count . ".</td>";
		echo "<td><img src=" . $fila2->imagendeportada . " width='40' height='40'/></td>";
		echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila2->idcanciones . "'>" . $fila2->titulocancion . " </a></td>";
		echo "<td><b>" . $fila2->minutos . ":" . $fila2->segundos . "</b></td>";
		echo "</tr>";
    $count = $count +1;
	}
	echo "<table>";
  }


  $albumes = "SELECT * FROM albumes WHERE artistas_idartistas = '$idartistas'";
  $resultado3 = $mysqli->query($albumes);
  if ($resultado3->num_rows>0){
		echo "<hr>";
		echo "<div>";
	  echo "<p style='font-size:30px; '><b>Álbumes</b></p>";
    while ($fila3 = $resultado3->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='Pagina_Album.php?idalbumes=" . $fila3->idalbumes . "'> <img src=" . $fila3->imagendeportada ." width='200' height='200'/></a>";
	 	echo "<p><b>" . $fila3->titulo .  "</b></p>";
		echo "<p><b> Año de Publicación: " . $fila3->anodepublicacion .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


	echo "<a href='NuevaAlbum.php?idartista=". $idartistas . "' class='menu'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nuevo Album</button></a><br/>";



  $recopilaciones = "SELECT * FROM recopilacionesdecanciones as rec  WHERE EXISTS (SELECT * FROM canciones_de_recopilatorios as rcan
    INNER JOIN canciones as can
    INNER JOIN albumes as alb
    INNER JOIN artistas as art
    WHERE art.idartistas = '$idartistas'
    and alb.artistas_idartistas = art.idartistas
    and can.albumes_idalbumes = alb.idalbumes
    and rcan.canciones_idcanciones = can.idcanciones
    and rcan.recopilacionesdecanciones_idrecopilacionesdecanciones = rec.idrecopilacionesdecanciones)";

  $resultado4 = $mysqli->query($recopilaciones);
  if ($resultado4->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Recopilaciones en las que aparece</b></p>";
    while ($fila4 = $resultado4->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
    echo "<img src=" . $fila4->imagen ." width='200' height='200'/>";
	 	echo "<p><b>" . $fila4->nombre .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


  $listas = "SELECT * FROM listasdereproduccioncanciones as rec  WHERE EXISTS (SELECT * FROM canciones_de_listas as rcan
    INNER JOIN canciones as can
    INNER JOIN albumes as alb
    INNER JOIN artistas as art
    WHERE art.idartistas = '$idartistas'
    and alb.artistas_idartistas = art.idartistas
    and can.albumes_idalbumes = alb.idalbumes
    and rcan.canciones_idcanciones = can.idcanciones
    and rcan.listasdereproduccioncanciones_idlistasdereproduccioncanciones = rec.idlistasdereproduccioncanciones)";

  $resultado5 = $mysqli->query($listas);
  if ($resultado5->num_rows>0){
		echo "<hr>";
	  echo "<div>";
	  echo "<p style='font-size:30px; '><b>Listas de reproducción en las que aparece</b></p>";
    while ($fila5 = $resultado5->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='ListaReproduccionCanciones.php?idlista=" . $fila5->idlistasdereproduccioncanciones . "&nombre=". $fila5->nombre ."&publica=". $fila5->publica . "'>
														 <p>" . $fila5->nombre .  "</p></a>";
    echo "</div>";
	}
	echo "<div>";
  }


  $seguidores = "SELECT * FROM usuarios as usu INNER JOIN artistas_seguidos as seg WHERE seg.usuarios_idusuarios = usu.idusuarios";

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
