<?php
$cadenaSQL = "UPDATE cancion SET num_reproducciones = num_reproducciones + 1 WHERE
                id_cancion = '$idcanciones'";
$mysqli->query($cadenaSQL);
?>