<?php 
Load::models('cantones');
class CantonesController extends AppController
{
    public function index($page=1){
        View::template('principal');
        $this->titulo="Cantones";
        $canton = new Cantones();
        $this->listaCantones = $canton->getCantones($page);
    }
    /**
  * create
  */
  public function create(){
        $this->titulo = "cantones";
        View::template('principal');
            if (Input::hasPost('cantones')){
                $canton = new Cantones(Input::post('cantones'));
            if (!$canton->create()){
            Flash::valid("creado exitosamente");
            Input::delete();
            return Redirect::to();
          }
          Flash::error("fallo la operacion");
      }
    }
    /**
     * edit
     */
    public function edit($id){
       View::template('principal');
        $canton = new Cantones();
        if (Input::hasPost('cantones')){
            if (!$canton->update(Input::post('cantones'))){
                Flash::error("fallo la operacion");
            }else{
                Flash::valid("creado exitosamente");
                return Redirect::to();
            }
        }else{
            $this->cantones = $canton->Find((int)$id);
        }
    }
    /**
     * delate
     */
    public function del($id){
        $canton = new Cantones();
        if(!$canton->delate((int)$id)){
            Flash::error("error al ingresar el canton");
        }else{
            Flash::valid("ingreso con exito");
        }
        return Redirect::to();
    }
}