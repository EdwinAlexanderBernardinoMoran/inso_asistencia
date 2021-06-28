<?php 

Load::models('especialidades');

class EspecialidadesController extends AppController{
    public function index(){
        View::template('principal');
            $this->titulo = "Alumnos";
            $especialidad = new Especialidades();
            $this->listaEspecialidades = $especialidad->getEspecialidades();
    }
}

?>
