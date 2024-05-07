<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    include_once('Conexion.php');
    $login = $_POST['login'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $tematica = $_POST['tematica'];
    $resultado = $mysqli->query("SELECT MAX(id_artistas) as maximo FROM artista");
    $fila = $resultado->fetch_object();
    $newId = $fila->maximo + 1;
    $cadenaSQL = "INSERT INTO artista(id_artistas,login,password,nombre,descripcion,num_reproducciones,imagen,id_tematica)
              VALUES ('$newId','$login','$password','$nombre','$descripcion',0,'$imagen','$tematica')";
    $mysqli->query($cadenaSQL);
    $mysqli->close();
    ?>
</body>

</html>