<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="micss.css">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>
  <?php
    include_once ('Conexion.php');
    session_start();
	
    echo "<form action='ScriptNuevaListaEpisodios.php' method='post' class='formulario' style='margin:20pt; background-color:black;color:white;'>";	
        echo "<p>Nombre (no usar comillas simples):</p>";
        echo "<input name='nombre' style='width:50%'><br>";
        echo "<input type='checkbox' name='privada' id='privada' value='on'>";
        echo "<label for='privada'>Privada</label>";

        $mysqli->close();
?>
        <table style="width:50%">
			<tr>
				<td><input type="hidden" name="idusuario" value="<?php $id = $_GET['usuario']; echo $id; ?>"/></td>
			</tr>
			<tr>
				<td>
				    <input type="submit" style='width:100%; background-color:green;color:white; text-align:center;' value="Crear" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
