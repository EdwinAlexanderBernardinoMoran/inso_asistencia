<?php 

    function conexion()
    {
        $host='localhost';
        $user='root';
        $pass='';
        $db='asistencias';

        $conexion=mysqli_connect($host,$user,$pass,$db);

        return $conexion;
    }


?>