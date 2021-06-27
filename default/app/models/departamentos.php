<?php 

    class Departamentos extends ActiveRecord{
        public function getDepartamentos($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>