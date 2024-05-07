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
    $titulo = $_POST['titulo'];
    $informacion = $_POST['informacion'];
    $imagen = $_POST['imagen'];
    $tematica = $_POST['tematica'];
    $resultado = $mysqli->query("SELECT MAX(id_podcast) as maximo FROM podcast");
    $fila = $resultado->fetch_object();
    $newId = $fila->maximo + 1;
    $cadenaSQL = "INSERT INTO podcast(id_podcast,login,password,titulo,informacion,num_seguidores,enlace_imagen,fecha_creacion,num_reproducciones,id_tematica)
              VALUES ('$newId','$login','$password','$titulo','$informacion',0,'$imagen',NOW(),0,'$tematica')";
    $mysqli->query($cadenaSQL);
    $mysqli->close();
    ?>
</body>

</html>