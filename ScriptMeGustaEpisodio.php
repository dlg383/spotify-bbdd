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
    $idepisodio = $_GET['idepisodio'];
    $cadenaSQL = "INSERT INTO usuario_likes_episodio(id_usuario,id_episodio)
              VALUES ('$idusuario','$idepisodio')";
    $mysqli->query($cadenaSQL);
    header("Location: Pagina_Episodio.php?idepisodio=" . $idepisodio);
    $mysqli->close();
    ?>
</body>

</html>