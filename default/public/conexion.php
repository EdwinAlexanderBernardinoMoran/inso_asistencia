<?php 

    function conexion()
    {
        $host='localhost';
        $user='Alexander';
        $pass='FrameworkPhp@22';
        $db='asistencias';

        $conexion=mysqli_connect($host,$user,$pass,$db);

        return $conexion;
    }


?>

