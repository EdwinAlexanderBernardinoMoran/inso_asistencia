<?php

    class CarrerasController extends AppController{
        public function index($page=1){
            View::template('principal');
            $this->titulo = "Especialidad de profesores";
            $carrera = new Carreras();
            $this->listaCarreras = $carrera->getCarreras($page);
        }

        public function create(){
            View::template('principal');
            $this->titulo = "Creando especialidad profesores";

            if (Input::hasPost('carreras')) {
                $carrera = new Carreras(Input::post('carreras'));

                if (!$carrera->create()) {
                    Flash::error('Error no se pudo crear la especialidad');
                } else {
                    Flash::valid("Alumno registrado exitosamente");
                    Input::delete();
                    return Redirect::to();
                }
            }
        }

        public function edit($id){
            View::template('principal');
            $this->titulo = "Actualizando especialidad de profesores";
            $carrera = new Carreras();

            if(Input::hasPost('carreras')){
                if(!$carrera->update(Input::post('carreras'))){
                    Flash::error('Fallo la operacion');
                }else{
                    Flash::valid('Operacion Exitosa');
                    return Redirect::to();
                }
            }else{
                $this->carreras = $carrera->find((int) $id);
            }
        }

        public function del($id){
            $carrera = new Carreras();
            if ($carrera->delete((int)$id)) {
                Flash::error("No se apodido eliminar la especialidad de profesores");
            } else{
                Flash::valid("Especialidad de profesores eliminada con exito");
            }
            return Redirect::to();
        }
    }

?>