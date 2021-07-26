<?php 

class Nacionalidades extends ActiveRecord{
    public function getNacionalidades($page, $ppage=20){
        // $naciona = Load::model('nacionalidades')->find_by_sql("select nacionalidades.nombre_nacionalidad from nacionalidades where nacionalidades.id=alumnos.id_nacionalidad");
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }
}

?>