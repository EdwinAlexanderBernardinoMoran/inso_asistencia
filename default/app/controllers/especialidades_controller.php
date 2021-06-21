<<<<<<< HEAD
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
=======
<?php
    Load::models('especialidades');

    class EspecialidadesController extends AppController{
        public function index($page=1){
            View::template('principal');
            $especialidad = new Especialidades();
            $this->especialidades = $especialidad->getEspecialidades('$page');

        }
    }
?>
>>>>>>> 35e118da6b966bc98eb933796b9199cdfb3e3a88
