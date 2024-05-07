<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
    $idusuario = $_POST['idusuario'];
	$nombre = $_POST['nombre'];
    if (isset($_POST['privada'])) {
        $priv = true;
    }else{
        $priv = false;
    }
    echo "<p>". $priv ."</p>";
    $resultado = $mysqli->query("SELECT MAX(id_lista_rep_canciones) as maximo FROM lista_reproduccion_canciones");
    $fila = $resultado->fetch_object();
    $newId = $fila->maximo + 1;

    $cadenaSQL = "INSERT INTO lista_reproduccion_canciones(id_lista_rep_canciones,id_usuario,nombre,publica)
              VALUES ('$newId','$idusuario','$nombre','$priv')";
    $mysqli->query($cadenaSQL);

    if (isset($_POST['canciones'])) {
        $cancionesSeleccionadas = $_POST['canciones'];

        foreach ($cancionesSeleccionadas as $cancionId) {
            $insertarCancion = "INSERT INTO lista_reproduccion_canciones_tiene_cancion(id_lista_rep_canciones,id_cancion)
              VALUES ('$newId','$cancionId')";
            $mysqli->query($insertarCancion);
        }
    }
  
    //header("Location: Listas.php?id=". $idusuario);

    $mysqli->close();
?>
</body>
</html>
