<?php 

require_once APP_PATH . '../../vendor/autoload.php';

use Mpdf\Mpdf;

Load::models('alumnos');

class AlumnosController extends AppController{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Alumnos";
        $alumno = new Alumnos();
        $this->listaAlumnos = $alumno->getAlumnos($page);
    }

    

    public function pdf($id)
    {
        //Usa el tempalte 'pdf'
        View::template('pdf/mpdf');
        //Modifica el nombre del archivo a descargar
        $this->fileName = 'user-list';
        //Modifica el título del documento PDF en la cabecera
        $this->title = 'Ficha de matricula';
        $this->listaAlumnos = new Alumnos();
        $this->download = false;
    }

    //REGISTRO DE ALUMNOS

    public function create (){
        View::template('principal');
        $this->titulo="Registro de alumnos";
        if (Input::hasPost('alumnos')){
            $alumno = new Alumnos(Input::post('alumnos'));
            // print_r($alumno);
            // return;
            if (!$alumno->create()){
                Flash::error('Fallo la operacion');
            }else{
                Flash::valid("Alumno registrado exitosamente");
                Input::delete();
                return Redirect::to();
            }
        }
    }

    // BOTON DE EDITAR UN REGISTROS
    public function edit($id){
        View::template('principal');
        $alumno = new Alumnos();
        if(Input::hasPost('alumnos')){
            if (!$alumno->update(Input::post('alumnos'))) {
                Flash::error("No se actualizao el registro");
            } else{
                Flash::valid("Datos del alumno actualizados");
                return Redirect::to();
            }
        } else {
            $this->alumnos = $alumno->find((int) $id);
        }
    }

    public function del($id){
        $alumno = new Alumnos();
        if(!$alumno->delete((int)$id)){
            Flash::error("No se apodido eliminar el alumno");
        }else{
            Flash::valid("Alumno eliminado con exito");
        }
        return Redirect::to();
    }

    public function barra(){
        View::template('principal');
        $this->titulo = "Codigo de Barras";
    }
}

?>