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
                return Redirect::to();
                // Input::delete();
            }
        }
    }

    public function edit($id){
        View::template('principal');
        $especialidad = new Especialidades();

        if(Input::hasPost('especialidades')){
            if(!$especialidad->update(Input::post('especialidades'))){
                Flash::error('Fallo la operacion');
            }else{
                Flash::valid('Operacion Exitosa');
                return Redirect::to();
            }
        }else{
            $this->especialidades = $especialidad->find((int) $id);
        }
    }

    public function del($id){
        $especialidad = new Especialidades();
        if(!$especialidad->delete((int)$id)){
            Flash::error("No se apodido eliminar la especialidad");
        }else{
            Flash::valid("Especialidad eliminada con exito");
        }
        return Redirect::to();
    }
}

?>
