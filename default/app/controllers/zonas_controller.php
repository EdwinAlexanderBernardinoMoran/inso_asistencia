<?php 
    Load::models('zonas');
class ZonasController extends AppController
{
    public function index($page=1){
        view::template('principal');
        $this->titulo="zonas";
        $zona = new Zonas();
        $this->listZonas = $zona->getZonas($page);
    }
 /**
  * create
  */
  public function create(){
        $this->titulo="zonas";
        view::template('principal');
            if (Input::hasPost('zonas')){
                $zona = new zonas(Input::post('zonas'));
            if (!$zona->create()) {
            flash::valid("creado exitosamente");
            Input::delate();
            return;
            }
           flash::error("fallo la operacion");
        }
    }
}