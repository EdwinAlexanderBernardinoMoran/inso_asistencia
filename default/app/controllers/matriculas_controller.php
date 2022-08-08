<?php

Load::models('matriculas');
Load::models('alumnos');
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

    public function codigobarras(){
        View::template('reporte');
        $this->titulo = "Codigo de barras";


        if (Input::hasPost('especialidad') && Input::hasPost('secciones') && Input::hasPost('anio')) {
            $this->Buscar_especialidad = $Buscar_especialidad = Input::post('especialidad');
            $this->Buscar_seccion = $Buscar_seccion = Input::post('secciones');
            $this->Buscar_anio = $Buscar_anio = Input::post('anio');
            $this->matriculas = (new Matriculas())->find("conditions: id_especialidad=$Buscar_especialidad and id_seccion=$Buscar_seccion and anio=$Buscar_anio");
        }

        
    //    if (empty(Input::hasPost('especialidad'))){
    //         // $this->Buscar_especialidad = $Buscar_especialidad = Input::post('especialidad');
    //         $this->Buscar_seccion = $Buscar_seccion = Input::post('secciones');
    //         $this->Buscar_anio = $Buscar_anio = Input::post('anio');
    //         $this->matriculas = (new Matriculas())->find("conditions: id_seccion=$Buscar_seccion and anio=$Buscar_anio");
    //     } else if(empty(Input::hasPost('secciones'))){

    //         $this->Buscar_anio = $Buscar_anio = Input::post('anio');
    //         $this->Buscar_especialidad = $Buscar_especialidad = Input::post('especialidad');
    //         $this->matriculas = (new Matriculas())->find("conditions: anio=$Buscar_anio and id_especialidad=$Buscar_especialidad");
            
    //     } else {
    //         $this->Buscar_especialidad = $Buscar_especialidad = Input::post('especialidad');
    //         $this->Buscar_seccion = $Buscar_seccion = Input::post('secciones');
    //         $this->Buscar_anio = $Buscar_anio = Input::post('anio');
    //         $this->matriculas = (new Matriculas())->find("conditions: id_especialidad=$Buscar_especialidad and id_seccion=$Buscar_seccion and anio=$Buscar_anio");
    //     }

    }
    

    public function comprobante(){
        View::template('principal');
        $this->titulo = "Comprobante de matricula";

        if (Input::hasPost('nombres') && Input::hasPost('anio')){
            $this->Nombres = $Nombres = Input::post('nombres');
            $this->Anio = $Anio = Input::post('anio');
            $this->comprobante = (new Matriculas())->find("conditions: id_alumnos=$Nombres and id_alumnos=$Nombres and id_alumnos=$Nombres and id_alumnos=$Nombres and anio=$Anio");
        } else {
            $this->comprobante = (new Matriculas());
        }
    }

    public function registros(){
        View::template('principal');
        $this->titulo = "Registros de estudiantes";
    }
}
?>