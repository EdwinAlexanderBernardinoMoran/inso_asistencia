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
