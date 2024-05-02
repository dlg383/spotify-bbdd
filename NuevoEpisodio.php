<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="micss.css">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>

	<form action="ScriptNuevoEpisodio.php" method="post" class="formulario" style='margin:20pt; background-color:black;color:white;'>
		<table>
            <tr>
				<td>Descripción (no usar comillas simples):</td>
				<td><textarea name="descripcion" rows="5" cols="120"></textarea></td>
			</tr>
			<tr>
				<td>Fecha de publicación:</td>
				<td><input type="date" name="fecha_publicacion" /></td>
			</tr>
            <tr>
				<td>Enlace:</td>
				<td><textarea name="enlace" rows="5" cols="120"></textarea></td>
			</tr>
            <tr>
				<td>Duración en minutos:</td>
				<td><input type="number" name="duracion" /></td>
			</tr>
			<tr>
				<td><input type="hidden" name="idpodcast" value="<?php $idpodcast = $_GET['idpodcast']; echo $idpodcast; ?>"/></td>
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
