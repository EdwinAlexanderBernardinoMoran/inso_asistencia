<?php 
    Load::models('zonas');
class ZonasController extends AppController
{
    public function index($page=1){
        View::template('principal');
        $this->titulo="zonas";
        $zona = new Zonas();
        $this->listaZonas = $zona->getZonas($page);
    }
 /**
  * create
  */
  public function create()
  {
        View::template('principal');
            $this->titulo="zonas";
            if (Input::hasPost('zonas')){
                $zona = new Zonas(Input::post('zonas'));
            if (!$zona->create()){
            Flash::valid("zona creada exitosamente");
            Input::delete();
            return Redirect::to();
            }
           Flash::error("fallo la operacion");
        }
    }
    /**
     * edit
     */
    public function edit($id_zona){
        View::template('principal');
        $this->titulo="zonas";
        $zona = new Zonas();
        if (Input::hasPost('zonas')){
            if (!$zona->update(Input::post('zonas'))){
                Flash::error("fallo la operacion");
            }else{
                Flash::valid("creado exitosamente");
                return Redirect::to();
            }
        }else{
            $this->zonas = $zona->Find((int)$id_zona); 
        }
    }
    /**
     * delate
     */
    public function del($id_zona){
        $zona = new Zonas();
        if(!$zona->delete((int)$id_zona)){
            Flash::error("error al ingresar la zona");
        }else{
            Flash::valid("ingreso con exito");
        }
        return Redirect::to();
    }
}