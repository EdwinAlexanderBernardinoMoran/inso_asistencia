
<?php

Load::models('matriculas');

class MatriculasController extends AppController
{
    public function index($page=1)
    {
        $this->titulo = "Matriculas";
        $matricula = new Matriculas();
        $this->ListaMatriculas = $matricula->getMatriculas($page);
    }

    //create

    public function create()
    {
        $this->titulo = "Registro matriculas";
        if (Input::hasPost('matriculas')){
            $matricula = new Matriculas(Input::post('matriculas'));
            if ($matricula->create()){
                Flash::valid("Matricula creada exitosamente");
                Input::delete();
                return;
            }
            Flash::error("Fallo al crear la matricula");
        }
    }

    //edit

    public function edit($id){
        $this->titulo = "Editando matricula";
        $matricula = new Matriculas();
        if (Input::hasPost('matriculas')){
            if (!$matricula->update(Input::post('matriculas'))){
                Flash::error("No se pudo editar la matricula");
            }else{
                Flash::valid("Matricula actualizada");
                return Redirect::to();
            }
        }else{
            $this->matriculas = $matricula->find((int) $id);
        }
    }

    //delete

    public function del($id)
    {
        $matricula = new Matriculas();
        if (!$matricula->delete((int) $id)){
            Flash::error("Error al eleiminar la matricula");
        } else{
            Flash::valid("Matricula borrada");
        }

        return Redirect::to();
    }
}


?>