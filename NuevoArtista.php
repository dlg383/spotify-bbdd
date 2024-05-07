<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="micss.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>

    <form action="ScriptNuevoArtista.php" method="post" class="formulario" style='margin:20pt; background-color:black;color:white;'>
        <table>
            <tr>
                <td>Login:</td>
                <td><input type="text" size="120" name="login" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" rows="5" cols="120"></input></td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" size="120" name="nombre" /></td>
            </tr>
            <tr>
                <td>Descripcion:</td>
                <td><textarea rows="5" cols="120" name="descripcion"></textarea></td>
            </tr>
            <tr>
                <td>Imagen:</td>
                <td><textarea rows="5" cols="120" name="imagen"></textarea></td>
            </tr>
            <tr>
                <td>Temática:</td>
                <td>
                    <?php
                    include_once('Conexion.php');
                    $tematicas = "SELECT * FROM tematica";
                    $resultado2 = $mysqli->query($tematicas);
                    echo "<select name='tematica' style='width:100%;'>";
                    while ($fila2 = $resultado2->fetch_object()) {
                        echo "<option style='background-color: white; color: black;'  value='" . $fila2->id_tematica . "'>" . $fila2->nombre . "</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    <input type="submit" style='width:300%; background-color:green;color:white;' value="Publicar" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>