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
            $this->titulo = "Edicion departamentos";
            if (Input::hasPost('departamentos')){
                $departamento = new Departamentos(Input::post('departamentos'));
                if ($departamento->create()){
                    Flash::valid("Departamento agregado exitosamente");
                    Input::delete();
                    return;
                }
                Flash::error("Fallo  al agregar el departamento");
            }
        }

        //edit

        public function edit($id){
            View::template('principal');
        }
    }

?>