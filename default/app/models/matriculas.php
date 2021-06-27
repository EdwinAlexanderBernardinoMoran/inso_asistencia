<?php

    class Matriculas extends ActiveRecord{
        public function getMatriculas($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id_matriculas desc');
        }
    }

?>