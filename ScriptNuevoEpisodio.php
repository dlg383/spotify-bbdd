<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    include_once('Conexion.php');
    $descripcion = $_POST['descripcion'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    echo "<p>" . $fecha_publicacion . "</p>";
    $enlace = $_POST['enlace'];
    $duracion = $_POST['duracion'];
    $idpodcast = $_POST['idpodcast'];
    $resultado = $mysqli->query("SELECT MAX(id_episodio) as maximo FROM episodio");
    $fila = $resultado->fetch_object();
    $newId = $fila->maximo + 1;
    $cadenaSQL = "INSERT INTO episodio(id_episodio,descripcion,fecha_publicacion,enlace,duracion,num_reproducciones,id_podcast)
              VALUES ('$newId','$descripcion','$fecha_publicacion','$enlace','$duracion',0,'$idpodcast')";
    if ($mysqli->query($cadenaSQL) === TRUE){
        echo "Episodio guardado exitosamente.";
    } else {
        echo "Error al guardar el episodio: " . $mysqli->error;
    }
    // Ejecutar la consulta
    // if ($mysqli->query($cadenaSQL) === TRUE) {
    //     echo "Fecha guardada exitosamente.";
    // } else {
    //     echo "Error al guardar la fecha: " . $mysqli->error;
    // }
    header("Location: Perfil_Podcast.php?idpodcast=" . $idpodcast);
    $mysqli->close();
    ?>
</body>

</html>