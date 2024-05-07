<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    include_once('Conexion.php');
    $usuario = $_GET['usuario'];
    $podcast =  $_GET['podcast'];
    $cadenaSQL = "INSERT INTO usuario_sigue_podcast(id_usuario,id_podcast) VALUES ($usuario,$podcast)";
    $mysqli->query($cadenaSQL);
    header("Location: Pagina_Podcast.php?idpodcast=" . $podcast);

    $mysqli->close();
    ?>
</body>

</html>