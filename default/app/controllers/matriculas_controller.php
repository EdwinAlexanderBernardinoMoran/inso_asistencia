
<?php

Load::models('matriculas');

class MatriculasController extends AppController
{
    public function index($page=1)
    {
        View::template('principal');
        $this->titulo = "Matriculas";
        $matricula = new Matriculas();
        $this->ListaMatriculas = $matricula->getMatriculas($page);
    }

    //edit

    public function edit($id_matriculas){
        View::template('principal');
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
            $this->matriculas = $matricula->find((int) $id_matriculas);
        }
    }

    //delete

    public function del($id_matriculas)
    {
        $matricula = new Matriculas();
        if (!$matricula->delete((int) $id_matriculas)){
            Flash::error("Error al eleiminar la matricula");
        } else{
            Flash::valid("Matricula borrada");
        }

        return Redirect::to();
    }
}


?>