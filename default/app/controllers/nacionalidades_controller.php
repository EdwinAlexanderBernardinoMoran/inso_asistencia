<?php 

Load::models('nacionalidades');

class NacionalidadesController extends AppController{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Nacionalidades";
        $nacionalidad = new Nacionalidades();
        $this->listaNacionalidades = $nacionalidad->getNacionalidades($page);
    }
}
?>