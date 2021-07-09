<?php 

Load::models('nacionalidades');

class NacionalidadesController extends AppController{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Nacionalidades";
        $nacionalidad = new Nacionalidades();
        $this->listaNacionalidades = $nacionalidad->getNacionalidades($page);
    }

    //REFISTRO DE NACIONALIDADES

    public function create (){
        if (Input::hasPost('nacionalidades')){
            $nacionalidad = new Nacionalidades(Input::post('nacionalidades'));
            if ($nacionalidad->create()) {
                Flash::valid("Nacionalidad creada");
                Input::delete();
                return Redirect::to();
            }else{
                Flash::error('Error al crear una nacionalidad');
            }
        }

        View::template('principal');
        $this->titulo = "Registro de nacionalidades";
    }

    //BOTON DE EDITAR UNA NACIONALIDADES
    public function edit($id){
        View::template('principal');
        $nacionalidad = new Nacionalidades();
        if (Input::hasPost('nacionalidades')){
            if (!$nacionalidad->update(Input::post('nacionalidades'))){
                Flash::error("Error no se pudo actualizar el registro");
            } else{
                Flash::valid("Datos de nacionalidad actualizados");
                return Redirect::to();
            }
        } else {
            $this->nacionalidades = $nacionalidad->find((int)$id);
        }
    }
}

?>