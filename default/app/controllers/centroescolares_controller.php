<?php 

Load::models('centroescolares');

class CentroescolaresController extends AppController
{
    public function index($page=1)
    {
        View::template('principal');
        $this->titulo = "Centros Escolares";
        $centroescolar = new Centroescolares();
        $this ->ListaCentroescolares = $centroescolar->getCentroescolares($page);
    }

    //edit

    public function edit($id)
    {
        View::template('principal');
        $this->titulo = "Centros Escolares";
        $centroescolar = new Centroescolares();
        if (Input::hasPost('centroescolares')) {
            if (!$centroescolar->update(Input::post('centroescolares'))) {
                Flash::error("No se pudo editar el centro escolar");
            }else{
                Flash::valid("Centro escolar actulaizado");
                return Redirect::to();
            }
        }else{
            $this->centroescolares = $centroescolar->find((int)$id);
        }
    }

    //delete

    public function del($id)
    {
        $centroescolar = new Centroescolares();
        if (!$centroescolar->delete((int)$id)) {
            Flash::error("Error al eliminar");
        }else{
            Flash::valid("Resgistro eliminado");
        }
        return Redirect::to();
    }
}

?>