<?php

    class CargosController extends AppController{
        
        public function index($page=1){
            View::template('principal');
            $this->titulo = "Cargo de profesores";

            $cargo = new Cargos();
            $this->listaCargos = $cargo->getCargos($page);
        }

        public function create(){
            View::template('principal');
            $this->titulo = "Creando cargo de profesores";

            if (Input::hasPost('cargos')) {
                $cargo = new Cargos(Input::post('cargos'));

                if (!$cargo->create()) {
                    Flash::error('Error no se pudo crear el cargo de profesores');
                } else {
                    Flash::valid('Cargo de profesores creado perfectamente');
                    Input::delete();
                    return Redirect::to();
                }
            }
        }

        public function edit($id){
            View::template('principal');
            $this->titulo = "Actualizando cargo de profesores";
            $cargo = new Cargos();

            if(Input::hasPost('cargos')){
                if(!$cargo->update(Input::post('cargos'))){
                    Flash::error('!!! Error !!! No se puede borrar el cargo');
                }else{
                    Flash::valid('Operacion Exitosa');
                    return Redirect::to();
                }
            }else{
                $this->cargos = $cargo->find((int) $id);
            }
        }

        public function del($id){
            $cargo = new Cargos();
            if ($cargo->delete((int)$id)) {
                Flash::error("No se apodido eliminar el cargo de profesores");
            } else{
                Flash::valid("Cargo de profesores eliminada con exito");
            }
            return Redirect::to();
        }
    }


?>