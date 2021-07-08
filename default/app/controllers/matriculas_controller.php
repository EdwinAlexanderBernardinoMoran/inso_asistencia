
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

    public function edit($id){
        View::template('principal');
        $this->titulo = "Editando matricula";
        $matricula1 = new Matricula();
        if (Input::hasPost('matricula')){
            if (!$matricula1->update(Input::post('matricula'))){
                Flash::error("No se pudo editar la matricula");
            }else{
                Flash::valid("Matricula actualizada");
                return Redirect::to();
            }
        }else{
            $this->matricula = $matricula1->find((int) $id);
        }
    }

    //delete

    public function del($id)
    {
        $matricula1 = new Matricula();
        if (!$matricula1->delete((int) $id)){
            Flash::error("Error al eleiminar la matricula");
        } else{
            Flash::valid("Matricula borrada");
        }

        return Redirect::to();
    }
}


?>