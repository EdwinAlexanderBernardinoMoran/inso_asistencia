<?php

Load::models('centros_escolares_providencias');

class Centros_escolares_providenciasController extends AppController
{

    public function index($page=1)
    {
        View::template('principal');
        $this->tiulo = "Centros Escolares";
        $centro_escolar = new Centros_escolares_providencias();
        $this->ListaCentros_escolares_providencias = $centro_escolar->getCentros_escolares_providencias($page);
    }

    //create 

    public function create()
    {
        View::template('principal');
        $this->titulo = "Centros Escolares";
        if (Input::hasPost('centros_escolares_providencias')){
            $centro_escolar = new Centros_escolares_providencias(Input::post('centros_escolares_providencias'));
            if ($centro_escolar->create()){
                Flash::valid("Centro escolar agregado exitosamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("Fallo al agregar el centro escolar");
        }
    }

    //edit

    public function edit($id_centroescolar)
    {
        View::template('principal');
        $this->titulo = "Centros Escolares";
        $centro_escolar = new Centros_escolares_providencias();
        if (Input::hasPost('centros_escolares_providencias')) {
            if ($centro_escolar->update(Input::post('centros_escolares_providencias'))) {
                Flash::error("No se pudo editar el centro escolar");
            }else{
                Flash::valid("Centro escolar actulaizado");
            }
        } else {
            $this->centros_escolares_providencias = $centro_escolar->find((int)$id_centroescolar);
        }
    }

    //delete

    public function del($id_centroescolar)
    {
        $centro_escolar = new Centros_escolares_providencias();
        if ($centro_escolar->delete((int)$id_centroescolar)) {
            Flash::error("Error al eliminar el centro escolar");
        } else{
            Flash::valid("Centro escolar eliminado");
        }
        return Redirect::to();
    }
}


?>