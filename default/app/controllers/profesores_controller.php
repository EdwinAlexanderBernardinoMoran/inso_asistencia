<?php 

Load::models('profesores');

class ProfesoresController extends AppController
{
    public function index($page=1)
    {
        View::template('principal');
        $this->titulo = "Profesores";
        $profesor = new Profesores();
        $this->ListaProfesores = $profesor->getProfesores($page);
    }

    //create

    public function create()
    {
        View::template('principal');
        $this->titulo = "Registro profesores";
        if (Input::hasPost('profesores')){
            $profesor = new Profesores(Input::post('profesores'));
            if ($profesor->create()){
                Flash::valid("Profesor registrado exitosamente");
                Input::delete();
                return;
            }
            Flash::error("Fallo al crear el registro del profesor");
        }
    }

    //edit

    public function edit($id){
        View::template('principal');
        $this->titulo = "Editando registro profesor";
        $profesor = new Profesores();
        if (Input::hasPost('profesores')){
            if (!$profesor->update(Input::post('profesores'))){
                Flash::error("No se pudo editar el registro ");
            }else{
                Flash::valid("Registro actualizado");
                return Redirect::to();
            }
        }else{
            $this->profesores = $profesor->find((int) $id);
        }
    }

    //delete

    public function del($id)
    {
        $profesor = new Profesores();
        if (!$profesor->delete((int)$id)){
            Flash::error("Error al eliminar el registro");
        }else{
            Flash::valid("Registro eliminado");
        }

        return Redirect::to();
    }
}


?>