<?php
    Load::models('caserios');
class CaseriosController extends AppController
{
    public function index($page=1){
        View::template('principal');
        $this->titulo="caserios";
        $caserio = new Caserios();
        $this->listaCaserios = $caserio->getCaserios($page);
    }
    /**
     * create
     */
    public function create (){
        View::template('principal');
        $this->titulo="caserios";
        if (Input::hasPost('caserios')){
            $caserio = new Caserios(Input::post('caserios'));
            if ($caserio->save()){
                Flash::valid("caserio creado exitosamente");
                Input::delete();
                return Redirect::to();
            } 
            Flash::error("error al crear el caserio");

        }
    }
    /** 
     * edit
    */
    public function edit($id){
        View::template('principal');
        $this->titulo="caserios";
        $caserio = new Caserios();
        if (Input::hasPost('caserios')){
            if(!$caserio->update(Input::post('caserios'))){
                Flash::error("fallo la operacion");
            } else {
                Flash::valid("creado exitosamente");
                return Redirect::to();
            }
        } else {
            $this->caserios = $caserio->find((int)$id);
        }
    }
    /**
     * delete
     */
    public  function del($id){
        $caserio = new Caserios();
        if(!$caserio->delete((int)$id)){
            Flash::error("error al ingresar la zona");
        }else{
            Flash::valid("ingreso exitosamente");
        }
        return Redirect::to();
    }
}