<?php

class Municipios extends ActiveRecord{
    public function getmunicipios($page, $ppage=20){
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }
}

?>

