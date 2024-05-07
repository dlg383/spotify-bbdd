<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
  <link rel="stylesheet" href="micss.css">
</head>

<body>
  <?php
  include_once('Conexion.php');
  $idcanciones = $_GET['idcanciones'];
  session_start();

  $id = $_SESSION['id'];
  $cancion = "SELECT * FROM cancion WHERE id_cancion='$idcanciones'";
  $resultado = $mysqli->query($cancion);
  $fila = $resultado->fetch_object();
  echo "<div style='margin-top:10px'>";

  echo "<iframe style='border-radius:12px; height:300px;'
   src='" . $fila->enlace_spotify . "'
   width='100%'; frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture' loading='lazy'></iframe>";

  echo "<p><b> Número de reproducciones: " . $fila->num_reproducciones .  "</b></p>";
  echo "<p><b> Duración: " . $fila->duracion_min . ":" . $fila->duracion_seg .  "</b></p>";

  if ($_SESSION['type'] == 'usuario') {
    $megusta = "SELECT * FROM usuario_likes_cancion WHERE id_usuario = '$id' and id_cancion = $idcanciones";
    $result = $mysqli->query($megusta);
    $f = $result->fetch_object();

    if($f->id_usuario == $id){
      echo "<button style='width:100%; background-color:green;color:white;' disabled>Ya le has dado me gusta a esta canción</button>";
    }else{
      echo "<a href='ScriptMeGustaCancion.php?idusuario=" . $id . "&idcancion=" . $idcanciones . "' class='menu'><button style='width:100%; background-color:green;color:white;'>Me Gusta</button></a><br/>";
    }

    echo "<form action='ScriptAnadirListaCanciones.php' method='post' class=formulario>";
    $listas = "SELECT * FROM lista_reproduccion_canciones WHERE id_usuario='$id'";
    $resultado2 = $mysqli->query($listas);
    echo "<input type='submit' style='width:100%; background-color:green;color:white;' value='Añadir a una lista de reproducción'>";
    echo "<select name='idlista' style='width:100%;'>";
    while ($fila2 = $resultado2->fetch_object()) {
      echo "<option style='background-color: white; color: black;'  value='" . $fila2->id_lista_rep_canciones . "'>" . $fila2->nombre . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='idcancion' style='width:300%; background-color:red;color:white;' value='" . $idcanciones . "' />";
    echo "</form>";
  }
  if ($_SESSION['type'] == 'administrador') {
    echo "<form action='ScriptAnadirRecopilacionCanciones.php' method='post' class=formulario>";
    $recopilaciones = "SELECT * FROM recopilacion_canciones WHERE id_admin='$id'";
    $resultado2 = $mysqli->query($recopilaciones);
    echo "<input type='submit' style='width:100%; background-color:green;color:white;' value='Añadir a una recopilación'>";
    echo "<select name='idlista' style='width:100%;'>";
    while ($fila2 = $resultado2->fetch_object()) {
      echo "<option style='background-color: white; color: black;'  value='" . $fila2->id_recopilacion_canciones . "'>" . $fila2->nombre . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='idcancion' style='width:300%; background-color:red;color:white;' value='" . $idcanciones . "' />";
    echo "</form>";
  }



  echo "</div>";



  $recopilaciones = "SELECT * FROM recopilacion_canciones as rec  WHERE EXISTS (SELECT * FROM recopilacion_canciones_tiene_cancion as rcan
     WHERE rcan.id_cancion = '$idcanciones'
     and rcan.id_recopilacion_canciones = rec.id_recopilacion_canciones)";

  $resultado4 = $mysqli->query($recopilaciones);
  if ($resultado4->num_rows > 0) {
    echo "<div>";
    echo "<p style='font-size:30px; '><b>Recopilaciones en las que aparece</b></p>";
    while ($fila4 = $resultado4->fetch_object()) {
      echo "<div class='column' style='margin: 20pt;'>";
      echo "<a class='menu' href='RecopilacionCanciones.php?idrecopilacion=" . $fila4->id_recopilacion_canciones .  "&nombre=" . $fila4->nombre . "'> <img src=" . $fila4->imagen . " width='200' height='200'/></a>";
      echo "<p><b>" . $fila4->nombre .  "</b></p>";
      echo "</div>";
    }
    echo "<div>";
  }


  $recopilaciones = "SELECT * FROM lista_reproduccion_canciones as rec  WHERE EXISTS (SELECT * FROM lista_reproduccion_canciones_tiene_cancion as rcan
     WHERE rcan.id_cancion = '$idcanciones'
     and rcan.id_lista_rep_canciones = rec.id_lista_rep_canciones)";

  $resultado5 = $mysqli->query($recopilaciones);
  if ($resultado5->num_rows > 0) {
    echo "<div>";
    echo "<p style='font-size:30px; '><b>Listas de reproducción en las que aparece</b></p>";
    while ($fila5 = $resultado5->fetch_object()) {
      echo "<div class='column' style='margin: 20pt;'>";
      echo "<a class='menu' href='ListaReproduccionCanciones.php?idlista=" . $fila5->id_lista_rep_canciones . "&nombre=" . $fila5->nombre . "&publica=" . $fila5->publica . "'>
 			 												<p>" . $fila5->nombre .  "</p></a>";
      echo "</div>";
    }
    echo "<div>";
  }


  $gustas = "SELECT * FROM usuario as usu INNER JOIN usuario_likes_cancion as mg WHERE mg.id_usuario = usu.id_usuario and mg.id_cancion='$idcanciones'";

  $resultado6 = $mysqli->query($gustas);
  if ($resultado6->num_rows > 0) {
    echo "<hr>";
    echo "<div>";
    echo "<p style='font-size:30px; '><b>Usuarios a los que le gusta</b></p>";
    while ($fila6 = $resultado6->fetch_object()) {
      echo "<div width='100%''>";
      echo "<img src=" . $fila6->imagen . "  class='avatar'/>";
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