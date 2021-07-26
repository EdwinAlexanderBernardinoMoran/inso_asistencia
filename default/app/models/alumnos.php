<?php 

class Alumnos extends ActiveRecord{
    public function getAlumnos($page, $ppage=20){
        // $alumnos = Load::model('alumnos')->find_by_sql("select nacionalidades.nombre_nacionalidad from nacionalidades where alumnos.id_nacionalidad=nacionalidades.id");

        // $alumnos = Load::model('alumnos')->find("columns: id_nacionalidad");
        // $usuario = Load::model('alumnos')->find_by_sql("select alumnos.id_nacionalidad from alumnos
        // where alumnos.id_nacionalidad=nacionalidades.id limit 1");
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }
}

?>