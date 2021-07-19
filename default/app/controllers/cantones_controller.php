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
    public function create (){
        View::template('principal');
        $this->titulo="cantones";
        if (Input::hasPost('cantones')){
            $canton = new Cantones(Input::post('cantones'));
            if ($canton->save()){
                Flash::valid("canton creado exitosamente");
                Input::delete();
                return Redirect::to();
            } 
            Flash::error("error al crear el canton"); 
        }
    }
    /**
     * edit
     */
    public function edit($id){
       View::template('principal');
       $this->titulo="cantones";
        $canton = new Cantones();
        if (Input::hasPost('cantones')){
            if (!$canton->update(Input::post('cantones'))){
                Flash::error("fallo la edicion del canton");
            }else{
                Flash::valid("canton creado exitosamente");
                return Redirect::to();
            }
        }else{
            $this->cantones = $canton->find((int)$id);
        }
    }
    /**
     * delete
     */
    public function del($id){
        $canton = new Cantones();
        if(!$canton->delete((int)$id)){
            Flash::error("error al ingresar el canton");
        }else{
            Flash::valid("ingreso con exito");
        }
        return Redirect::to();
    }
}