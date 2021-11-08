<?php

    class Matriculas extends ActiveRecord{
        public function getMatriculas($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }

        public function buscar($criterio){
            $sql= "SELECT * FROM `matriculas` WHERE id_alumnos LIKE '%{$criterio}%'";
           $matriculas1 = (new Matriculas)->find_all_by_sql($sql);
           return $matriculas1;
        }
    }

?>