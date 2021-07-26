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
        if (Input::hasPost('alumnos')){
            $alumno = new Alumnos(Input::post('alumnos'));
            if (!$alumno->save()){
                Flash::error("Fallo la Operacion");
            }else{
                Flash::valid("Operacion exitosa");
                Input::delete();
                return Redirect::to();
            }
        }

        View::template('principal');
        $this->titulo = "Registro de alumnos";
    }

    // BOTON DE EDITAR UN REGISTROS
    public function edit($id){
        View::template('principal');
        $alumno = new Alumnos();
        if(Input::hasPost('alumnos')){
            if (!$alumno->update(Input::post('alumnos'))) {
                Flash::error("No se actualizao el registro");
            } else{
                Flash::valid("Datos del alumno actualizados");
                return Redirect::to();
            }
        } else {
            $this->alumnos = $alumno->find((int)$id);
        }
    }
}

?>