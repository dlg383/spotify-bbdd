<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    include_once('Conexion.php');
    $idlista = $_POST['idlista'];
    $idepisodio = $_POST['idepisodio'];
    $cadenaSQL = "INSERT INTO recopilacion_episodios_tiene_episodio(id_recopilacion_episodios,id_episodio)
              VALUES ('$idlista','$idepisodio')";
    echo $cadenaSQL;
    $mysqli->query($cadenaSQL);
    header("Location: Pagina_Episodio.php?idepisodio=" . $idepisodio);
    $mysqli->close();
    ?>
</body>

</html>