<?php

Load::models('secciones');

class SeccionesController extends AppController
{
    public function index($page=1)
    {
        View::Template('principal');
        $this->titulo = "Secciones";
        $seccion = new Secciones();
        $this->listaSecciones = $seccion->getSecciones($page);
    }

    public function create(){
        View::template('principal');
        $this->titulo = "Creando cargo de profesores";

        if (Input::hasPost('secciones')) {
            $seccion = new Secciones(Input::post('secciones'));

            if (!$seccion->create()) {
                Flash::error('Error no se pudo crear la seccion');
            } else {
                Flash::valid('Seccion creada perfectamente');
                Input::delete();
                return Redirect::to();
            }
        }
    }

    public function edit($id){
        View::template('principal');
        $this->titulo = "Actualizando Secciones";
        $seccion = new Secciones();

        if (Input::hasPost('secciones')) {
            if ($seccion->update(Input::post('secciones'))) {
                Flash::valid('Operacion exitosa');
                return Redirect::to();
            } else{
                Flash::error('¡¡¡ Error !!! No se puede editar la seccion');
            }
        } else {
            $this->secciones = $seccion->find((int) $id);
        }
    }

    public function del($id){
        $seccion = new Secciones();
        if ($seccion->delete((int)$id)) {
            Flash::valid("Cargo de profesores eliminada con exito");
        } else{
            Flash::error("No se apodido eliminar el cargo de profesores");
        }
        return Redirect::to();
    }
}