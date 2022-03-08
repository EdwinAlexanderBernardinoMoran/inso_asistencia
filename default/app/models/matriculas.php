<?php

    class Matriculas extends ActiveRecord{

        public function initialize(){
            $this->belongs_to('Alumnos', 'model: Alumnos', 'fk: id_alumnos');
            $this->belongs_to('Especialidades', 'model: Especialidades', 'fk: id_especialidad');
        }

        public function before_create(){

            if ($matricula1=$this->find_first("conditions: id_alumnos=$this->id_alumnos and id_seccion=$this->id_seccion")) {
                Flash::warning("El alumno con este ID ya esta matriculado en esta seccion");
                return 'cancel';
            }

            if ($matricula2=$this->find_first("conditions: id_alumnos=$this->id_alumnos and anio=$this->anio")) {
                Flash::warning("El alumno no puede matricularse dos veces en el mismo año");
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