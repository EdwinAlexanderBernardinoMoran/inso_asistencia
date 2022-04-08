<?php

    class Carreras extends ActiveRecord{
        public function getCarreras($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>