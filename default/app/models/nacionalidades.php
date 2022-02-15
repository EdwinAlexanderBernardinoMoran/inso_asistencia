<?php 

class Nacionalidades extends ActiveRecord{
    public function getNacionalidades($page, $ppage=20){

        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }

    // public function all(){
    //     return $this->find('order: nombre_nacionalidad');
    // }
}

?>