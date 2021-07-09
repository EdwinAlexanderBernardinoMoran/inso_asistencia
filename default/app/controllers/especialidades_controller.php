<?php 

Load::models('especialidades');

class EspecialidadesController extends AppController{
    public function index(){
        View::template('principal');
        $this->titulo = "Especialidades";
        $especialidad = new Especialidades();
        $this->listaEspecialidades = $especialidad->getEspecialidades($page=1);
    }
    public function create(){
        View::template('principal');
        $this->titulo = "Creando Especialidad";

        if(Input::hasPost('especialidades')){
            $especialidad = new Especialidades(Input::post('especialidades'));
            if(!$especialidad->save()){
                Flash::error('Fallo la operacion');
            }else{
                Flash::valid('Operacion exitosa');
                Input::delete();
            }
        }
    }
}

?>
