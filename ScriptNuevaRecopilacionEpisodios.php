<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    include_once('Conexion.php');
    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen'];
    $fecha = $_POST['fecha'];
    $idadmin = $_POST['idadmin'];
    $resultado = $mysqli->query("SELECT MAX(id_recopilacion_episodios) as maximo FROM recopilacion_episodios");
    $fila = $resultado->fetch_object();
    $newId = $fila->maximo + 1;
    $cadenaSQL = "INSERT INTO recopilacion_episodios(id_recopilacion_episodios,nombre,imagen,fecha,id_admin)
              VALUES ('$newId','$nombre','$imagen','$fecha','$idadmin')";
    $mysqli->query($cadenaSQL);
    
    $mysqli->close();
    ?>
</body>

</html> 
