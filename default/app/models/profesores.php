<?php 
    class Profesores extends ActiveRecord{
        public function getProfesores($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }

        public function initialize(){
            $this->belongs_to('Carreraprofesor', 'model: Carreras', 'fk: carrera_id');
        }
    
    }
?>