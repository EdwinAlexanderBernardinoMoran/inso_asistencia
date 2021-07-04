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
            if (!$zona->create(Input::post('zonas'))){
            Flash::error('fallo la creacion de zona');
            Flash::valid('zona creada exitosamente');
            }else{
           
           Input::delete();
            return Redirect::to();
            }
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
                Flash::error("fallo la edicion de la zona");
            } else {
                Flash::valid("creada exitosamente la zona");
                return Redirect::to();
            }
<<<<<<< HEAD
        } else {
            $this->zonas = $zona->find((int)$id); 
=======
        }else{
            $this->zonas = $zona->Find((int)$id_zona); 
>>>>>>> 460a40a6acc0495717346ce7f7665288bb503a0b
        }
    }
    /**
     * delate
     */
    public function del($id_zona){
        $zona = new Zonas();
<<<<<<< HEAD
        if(!$zona->delete((int)$id)){
=======
        if(!$zona->delete((int)$id_zona)){
>>>>>>> 460a40a6acc0495717346ce7f7665288bb503a0b
            Flash::error("error al ingresar la zona");
        }else{
            Flash::valid("ingreso con exito");
        }
        return Redirect::to();
    }
}