<?php

Load::models('matriculas');
class MatriculasController extends AppController
{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Matriculas";
        $matricula = new Matriculas();
        $this->listaMatriculas = $matricula->getMatriculas($page);

    }

    //create

    public function create(){
        // Flash::info(Input::get('buscar'));

        if (Input::hasPost('buscar')) {
            $buscar = Input::post('buscar');
            $this->matricula = (new Matriculas())->buscar($buscar);
        } else {
            $this->matricula = (new Matriculas());
        }

        View::template('principal');
        $this->titulo = "Matriculas";
        if (Input::hasPost('matriculas')) {
            $matricula = new Matriculas(Input::post('matriculas'));
            if ($matricula->create()) {
                Flash::valid("Matricula creada correctamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("Error, la matricula no fue agregada");
        }
    }

    //edit

    public function edit($id){
        View::template('principal');
        $this->titulo = "Editando matricula";
        $matricula = new Matriculas();
        $this->listaMatriculas = $matricula->find("conditions: id=$id");
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

    public function del($id){
        $matricula = new Matriculas();
        if (!$matricula ->delete((int) $id)){
            Flash::error("Error al eleiminar la matricula");
        } else{
            Flash::valid("Matricula borrada");
        }

        return Redirect::to();
    }

    public function filtrado(){
        View::template('principal');
        $this->titulo = "Filtrado de datos";

    }
    // $this->matriculas = (new Matriculas())->filtros($Buscar_especialidad, $Buscar_seccion, $Buscar_anio);

    // $listaAlumnos = $this->listaAlumnos = $alumno->find("conditions: id=$id");

    public function codigobarras($Buscar_especialidad = NULL, $Buscar_seccion = NULL, $Buscar_anio = NULL){

        if (Input::hasPost('especialidad') && Input::hasPost('secciones') && Input::hasPost('anio')){
            $this->Buscar_especialidad = $Buscar_especialidad = Input::post('especialidad');
            $this->Buscar_seccion = $Buscar_seccion = Input::post('secciones');
            $this->Buscar_anio = $Buscar_anio = Input::post('anio');
            $this->matriculas = (new Matriculas())->find("conditions: id_especialidad=$Buscar_especialidad and id_seccion=$Buscar_seccion and anio=$Buscar_anio");
        } else {
            $this->matriculas = (new Matriculas())->find();
        }
        View::template('reporte');
        $this->titulo = "Codigo de barras";

        
        // $this->matriculas = (new Matriculas())->find("conditions: id_especialidad=$Buscar_especialidad and id_seccion=$Buscar_seccion and anio=$Buscar_anio");
    }
}
?>