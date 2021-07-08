<?php 

    class Centroescolares extends ActiveRecord {
        public function getCentroescolares($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>