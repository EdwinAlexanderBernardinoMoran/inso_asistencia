<?php

Load::models('alumnos');

class AlumnosController extends AppController{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Alumnos";
        $alumno = new Alumnos();
        $this->listaAlumnos = $alumno->getAlumnos($page);
    }

    //REGISTRO DE ALUMNOS

    public function registros(){
        View::template('principal');
        $this->titulo = "Registro de alumnos";
    }
}

?>