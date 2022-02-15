<?php

    class Matriculas extends ActiveRecord{

        public function initialize(){
            $this->belongs_to('Alumnos', 'model: Alumnos', 'fk: id_alumnos');
            $this->belongs_to('Especialidades', 'model: Especialidades', 'fk: id_especialidad');
        }

        public function before_create(){
            $resultado = $this->find_first("id_alumnos = $this->id_alumnos");
            if ($resultado) {
                Flash::warning("Ya existe un usuario registrado");
                return 'cancel';
            }
        }

        public function getMatriculas($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }

        public function buscar($buscar){
            $sql = "SELECT alumnos.id, alumnos.nie, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, alumnos.anio_bachillerato, especialidades.nombre_especialidad FROM alumnos, especialidades WHERE nie LIKE '%{$buscar}%' AND alumnos.id_especialidad_ingreso=especialidades.id";
            $matricula = (new Matriculas)->find_all_by_sql($sql);
            return $matricula;
        }
    }

?>