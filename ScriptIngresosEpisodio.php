<?php
$cadenaSQL = "UPDATE episodio SET num_reproducciones = num_reproducciones + 1 WHERE
                id_episodio = '$idepisodio'";
$mysqli->query($cadenaSQL);
?>