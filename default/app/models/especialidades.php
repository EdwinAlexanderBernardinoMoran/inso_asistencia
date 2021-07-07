<?php
    class Especialidad extends ActiveRecord{
        public function getEspecialidades($page, $ppage=20){
            return $this->paginate("page: $page","per_page: $ppage","order: id desc");
        }
    }