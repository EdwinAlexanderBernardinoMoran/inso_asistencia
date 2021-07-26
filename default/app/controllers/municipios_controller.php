<?php
Load::models('municipios');
class MunicipiosController extends AppController
{
    public function index($page=1)
    {
        View::template('principal');
        $this->titulo = "Municipios";
        $municipio = new Municipios();
        $this->ListaMunicipios = $municipio->getMunicipios($page);
    }
//create
    public function create()
    {
        View::template('principal');
        $this->titulo = "Municipios";
        if (Input::hasPost('municipios')){
            $municipio = new Municipios(Input::post('municipios'));
            if ($municipio->create()) {
                Flash::valid("Municipio agregado exitosamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("Fallo al agregar el municipio");
        }
    }
    //edit
    public function edit($id)
    {
        View::template('principal');
        $this->titulo = "Editando municipio";
        $municipio = new Municipios();
        if(Input::hasPost('municipios')){
            if (!$municipio->update(Input::post('municipios'))){
                Flash::error("Fallo al editar el municipio");
            } else {
                Flash::valid("Municipio actualizado con éxito");
                return Redirect::to();
            }
        } else {
            $this->municipios = $municipio->find((int) $id);
        }
    }
    //delete
    public function del($id)
    {
        $municipio = new Municipios();
        if (!$municipio->delete((int)$id)) {
            Flash::error("Error al eliminar el municipio");
        } else {
            Flash::valid("Municipio eliminado con éxito");
        }
        return Redirect::to();
    }
}

?>