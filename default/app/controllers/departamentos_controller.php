<?php

Load::models('departamentos');

class DepartamentosController extends AppController
{
    public function index($page=1)
    {
        View::template('principal');
        $this->titulo = "Departamentos";
        $departamento = new Departamentos();
        $this->ListaDepartamentos = $departamento->getDepartamentos($page);
    }

    //create

    public function create()
    {
        View::template('principal');
        $this->titulo = "Departamentos";
        if (Input::hasPost('departamentos')) {
            $departamento = new Departamentos(Input::post('departamentos'));
            if ($departamento->create()) {
                Flash::valid("Departamento agregado correctamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("Fallo al registrar departamento");
        }
    }

    //edit

    public function edit($id)
    {
        View::template('principal');
        $this->titulo = "Editando departamento";
        $departamento = new Departamentos();
        if (Input::hasPost('departamentos')) {
            if (!$departamento->update(Input::post('departamentos'))) {
                Flash::error("No se pudo editar el departamento");
            } else {
                Flash::valid("Departamento actualizado");
                return Redirect::to();
            }
        } else {
            $this->departamentos = $departamento->find((int)$id);
        }
    }

    //delete

    public function del($id)
    {
        $departamento = new Departamentos();
        if (!$departamento->delete((int)$id)) {
            Flash::error("Error al eliminar el departamento");
        } else {
            Flash::valid("Departamento eliminado");
        }
        return Redirect::to();
    }
}


?>