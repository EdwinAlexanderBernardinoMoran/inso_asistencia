<?php 

    class Departamentos extends ActiveRecord{
        public function getDepartamentos($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }

        public function before_delete(){

            if($this->id == 22){
                Flash::error("No se puede borrar Departamento");
                return 'cancel';
                }
                
        }
    }

?>
