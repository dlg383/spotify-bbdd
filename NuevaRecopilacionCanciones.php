<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="micss.css">
	<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>

	<form action="ScriptNuevaRecopilacionCanciones.php" method="post" class="formulario" style='margin:20pt; background-color:black;color:white;'>
		<table>
			<tr>
				<td>Nombre:</td>
				<td><input type="text" size="120" name="nombre" /></td>
			</tr>
			<tr>
				<td>Imagen:</td>
				<td><textarea name="imagen" rows="5" cols="120"></textarea></td>
			</tr>
			<tr>
				<td>Fecha:</td>
				<td><input type="date" name="fecha" /></td>
			</tr>
			<tr>
				<td><input type="hidden" name="idadmin" value="
				<?php
				$idadmin = $_GET['admin'];
				echo $idadmin; ?>" /></td>
			</tr>
			<tr>
				<td>
					<input type="submit" style='width:300%; background-color:green;color:white;' value="Publicar" />
				</td>
			</tr>
		</table>
	</form>
</body>

</html>