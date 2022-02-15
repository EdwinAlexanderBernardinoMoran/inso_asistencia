<?php 

class Alumnos extends ActiveRecord{

    public function initialize(){
        $this->belongs_to('Especialidades', 'model: Especialidades', 'fk: id_especialidad_ingreso');
    }

    public function getAlumnos($page, $ppage=20){
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }
    
    // public function getAlumno(){
    //     return $this->find();
    // }
}

?>