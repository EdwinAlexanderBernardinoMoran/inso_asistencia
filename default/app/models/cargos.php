<?php

    class Cargos extends ActiveRecord{
        public function getCargos($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>