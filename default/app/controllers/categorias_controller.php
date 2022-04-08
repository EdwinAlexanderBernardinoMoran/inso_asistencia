<?php

    class CategoriasController extends AppController
    {
        public function index($page=1){
            View::template('principal');
            $this->titulo = "Categorias profesores";
            $categoria = new Categorias();
            $this->listaCategorias = $categoria->getCategorias($page);
        }

        public function create(){
            View::template('principal');
            $this->titulo = "Creando categoria";

            if (Input::hasPost('categorias')) {
                $categoria = new Categorias(Input::post('categorias'));
                if (!$categoria->create()) {
                    Flash::error('Fallo la operacion');
                } else {
                    Flash::valid("Categoria registrado exitosamente");
                    Input::delete();
                    return Redirect::to();
                }
            }
        }

        public function edit($id){
            View::template('principal');
            $this->titulo = "Actualizando categoria de profesores";
            $categoria = new Categorias();

            if(Input::hasPost('categorias')){
                if(!$categoria->update(Input::post('categorias'))){
                    Flash::error('Fallo la operacion');
                }else{
                    Flash::valid('Operacion Exitosa');
                    return Redirect::to();
                }
            }else{
                $this->categorias = $categoria->find((int) $id);
            }
        }

        public function del($id){
            $categoria = new Categorias();
            if (!$categoria->delete((int)$id)) {
                Flash::error('No se ha podido eliminar la categoria');
            } else{
                Flash::valid('Categoria eliminada con exito');
            }
            return Redirect::to();
        }
    }
?>