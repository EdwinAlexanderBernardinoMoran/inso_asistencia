<?php 
    Load::models('zonas');
class ZonasController extends AppController
{
    public function index($page=1){
        view::template('principal');
        $this->titulo="zonas";
        $zona = new Zonas();
        $this->listaZonas = $zona->getZonas($page);
    }
 /**
  * create
  */
  public function create(){
        $this->titulo="zonas";
        view::template('principal');
            if (Input::hasPost('zonas')){
                $zona = new Zonas(Input::post('zonas'));
            if (!$zona->create()) {
            flash::valid("creado exitosamente");
            Input::delete();
            return;
            }
           flash::error("fallo la operacion");
        }
    }
    /**
     * edit
     */
    public function edit($id){
        view::template('principal');
        $zona = new Zonas();
        if (Input::hasPost('zonas')){
            if (!$zona->update(Input::post('zonas'))){
                Flash::error("fallo la operacion");
            }else{
                Flash::valid("creado exitosamente");
                return Redirect::to();
            }
        }else{
            $this->zonas = $zona->Find((int)$id); 
        }
    }
    public function del($id){
        $zona = new Zonas();
        if(!$zona->delate((int)$id)){
            Flash::error("error al ingresar la zona");
        }else{
            Flash::valid("ingreso con exito");
        }
        return Redirect::to();
    }
}