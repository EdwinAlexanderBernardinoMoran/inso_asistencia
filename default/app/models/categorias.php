<?php

    class Categorias extends ActiveRecord{
        public function getCategorias($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>