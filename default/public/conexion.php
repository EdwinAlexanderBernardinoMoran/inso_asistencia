<?php 

    function conexion()
    {
        $host='localhost';
        $user='root';
        $pass='lasttip2021';
        $db='asistencias';

        $conexion=mysqli_connect($host,$user,$pass,$db);

        return $conexion;
    }


?>