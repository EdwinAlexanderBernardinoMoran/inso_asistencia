<?php 

class Centros_escolares extends ActiveRecord{
    public function getCentros_escolares_providencias($page, $ppage=20){
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }
}

?>