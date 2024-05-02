<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    include_once('Conexion.php');
    $idusuario = $_GET['idusuario'];
    $idcancion = $_GET['idcancion'];
    $cadenaSQL = "INSERT INTO usuario_likes_cancion(id_usuario,id_cancion)
              VALUES ('$idusuario','$idcancion')";
    $mysqli->query($cadenaSQL);
    header("Location: Pagina_Cancion.php?idcanciones=" . $idcancion);
    $mysqli->close();
    ?>
</body>

</html>