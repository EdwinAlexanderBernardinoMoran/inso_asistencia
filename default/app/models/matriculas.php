<?php

    class Matriculas extends ActiveRecord{

        public function initialize(){
            $this->belongs_to('Alumnos', 'model: Alumnos', 'fk: id_alumnos');
            $this->belongs_to('Especialidades', 'model: Especialidades', 'fk: id_especialidad');
            $this->belongs_to('Secciones', 'model: Secciones', 'fk: id_seccion');
        }
        
        public function before_create(){

            if ($matricula1=$this->find_first("conditions: id_alumnos=$this->id_alumnos and id_seccion=$this->id_seccion and anio=$this->anio")) {
                Flash::warning("El alumno con este ID ya esta matriculado en esta seccion");
                return 'cancel';
            }

            if ($matricula2=$this->find_first("conditions: id_alumnos=$this->id_alumnos and anio=$this->anio")) {
                Flash::warning("El alumno no puede matricularse dos veces en el mismo año");
                return 'cancel';
            }
            
        }

        public function getMatriculas($page, $ppage=10){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');

        }

        public function buscar($buscar){
            $sql = "SELECT alumnos.id, alumnos.nie, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, alumnos.anio_bachillerato, especialidades.nombre_especialidad FROM alumnos, especialidades WHERE nie LIKE '%{$buscar}%' AND alumnos.id_especialidad_ingreso=especialidades.id";
            $matricula = (new Matriculas)->find_all_by_sql($sql);
            return $matricula;
        }
        
        // public function filtros($Buscar_especialidad, $Buscar_seccion, $Buscar_anio){
        //     $query = "SELECT matriculas.id, matriculas.id_seccion, matriculas.anio, alumnos.nie, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, especialidades.nombre_especialidad FROM matriculas, alumnos, especialidades WHERE nombre_especialidad LIKE '%{$Buscar_especialidad}%' AND id_seccion LIKE '%{$Buscar_seccion}%' AND anio LIKE '%{$Buscar_anio}%' AND matriculas.id_alumnos=alumnos.id AND matriculas.id_especialidad=especialidades.id";
        //     $matricula = (new Matriculas)->find_all_by_sql($query);
        //     return $matricula;
        // }

        // public function otros($Buscar_especialidad, $Buscar_anio){
        //     $query = "SELECT matriculas.id, matriculas.id_seccion, matriculas.anio, alumnos.nie, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, especialidades.nombre_especialidad FROM matriculas, alumnos, especialidades WHERE nombre_especialidad LIKE '%$Buscar_especialidad%' AND anio LIKE '%$Buscar_anio%' AND matriculas.id_alumnos=alumnos.id AND matriculas.id_especialidad=especialidades.id";
        //     $matricula = (new Matriculas)->find_all_by_sql($query);
        //     return $matricula;
        // }

        public function comprobante($nombres, $anio){
            $query = "SELECT matriculas.id, matriculas.id_seccion, matriculas.anio, alumnos.nie, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, especialidades.nombre_especialidad FROM matriculas, alumnos, especialidades WHERE primer_nombre LIKE '%$nombres%' AND anio LIKE '%$anio%' AND matriculas.id_alumnos=alumnos.id AND matriculas.id_especialidad=especialidades.id";
            $matricula = (new Matriculas)->find_all_by_sql($query);
            return $matricula;
        }

        // public function campos(){
        //     $query = "SELECT matriculas.id, matriculas.id_seccion, matriculas.anio, alumnos.nie, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, especialidades.nombre_especialidad FROM matriculas, alumnos, especialidades WHERE matriculas.id_alumnos=alumnos.id AND matriculas.id_especialidad=especialidades.id";
        //     $matricula = (new Matriculas)->find_all_by_sql($query);
        //     return $matricula;
        // }
    }
?>