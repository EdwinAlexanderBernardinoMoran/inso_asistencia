<?php

class Municipios extends ActiveRecord{
    public function getMunicipios($page, $ppage=20){
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id_minicipio desc'); 
    }
}

?>

