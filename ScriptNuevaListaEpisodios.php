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
        $priv = false; // Si se marca la casilla "Privada", la lista no será pública
    }else{
        $priv = true; // Si no se marca la casilla "Privada", la lista será pública
    }
    echo "<p>". $priv ."</p>";
    $resultado = $mysqli->query("SELECT MAX(id_lista_rep_episodios) as maximo FROM lista_reproduccion_episodios");
    $fila = $resultado->fetch_object();
    $newId = $fila->maximo + 1;

    $cadenaSQL = "INSERT INTO lista_reproduccion_episodios(id_lista_rep_episodios,id_usuario,nombre,publica)
              VALUES ('$newId','$idusuario','$nombre','$priv')";
    $mysqli->query($cadenaSQL);

    header("Location: Listas.php?id=". $idusuario);

    $mysqli->close();
?>
</body>
</html>
