<?php

    class Matricula extends ActiveRecord{
        public function getMatricula($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>