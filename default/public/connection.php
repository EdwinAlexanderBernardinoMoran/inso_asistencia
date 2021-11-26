<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'asistencias'
);

if (isset($conn)) {
    echo "La base de datos esta conectada";
}

?>