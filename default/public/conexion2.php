<?php 

$conect = mysqli_connect("localhost", "root", "", "asistencias");

if ($conect) {
    echo "La base de datos esta conectada";
}else {
    echo "La base de datos esta desconectada";
}

?>