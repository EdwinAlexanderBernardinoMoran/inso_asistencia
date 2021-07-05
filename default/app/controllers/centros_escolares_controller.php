<?php

Load::models('centros_escolares');

class Centros_escolaresController extends AppController
{

    public function index($page=1)
    {
        View::template('principal');
        $this->tiulo = "Centros Escolares";
        $centro_escolar = new Centros_escolares();
        $this->ListaCentros_escolares = $centro_escolar->getCentros_escolares($page);
    }

    //create 

    public function create()
    {
        View::template('principal');
        $this->titulo = "Centros Escolares";
        if (Input::hasPost('centros_escolares')){
            $centro_escolar = new Centros_escolares(Input::post('centros_escolares'));
            if ($centro_escolar->create()){
                Flash::valid("Centro escolar agregado exitosamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("Fallo al agregar el centro escolar");
        }
    }

    //edit

    public function edit($id)
    {
        View::template('principal');
        $this->titulo = "Centros Escolares";
        $centro_escolar = new Centros_escolares();
        if (Input::hasPost('centros_escolares')) {
            if ($centro_escolar->update(Input::post('centros_escolares'))) {
                Flash::error("No se pudo editar el centro escolar");
            }else{
                Flash::valid("Centro escolar actulaizado");
            }
        } else {
            $this->centros_escolares_providencias = $centro_escolar->find((int)$id);
        }
    }

    //delete

    public function del($id)
    {
        $centro_escolar = new Centros_escolares();
        if ($centro_escolar->delete((int)$id)) {
            Flash::error("Error al eliminar el centro escolar");
        } else{
            Flash::valid("Centro escolar eliminado");
        }
        return Redirect::to();
    }
}


?>