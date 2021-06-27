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
    public function create(){
        $this->titulo="caserios";
        View::template('principal');
            if (Input::hasPost('caserios')){
                $caserio = new Caserios(Input::post('caserios'));
            if (!$caserio->create()){
                Flash::valid("creado exitosamente");
                Input::delate();
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
        $this->titulo="";
        $caserio = new Caserios();
        if (Input::hasPost('Caserios')){
            if(!$caserio->update(Input::post('caserios'))){
                Flash::error("fallo la operacion");
            }else{
                Flash::valid("creado exitosamente");
                return Redirect::to();
            }
        }else{
            $this->caserios = $caserio->Find((int)$id);
        }
    }
    /**
     * delate
     */
    public  function del($id){
        $caserio = new Caserios();
        if(!$caserio-delate((int)$id)){
            Flash::error("error al ingresar la zona");
        }else{
            Flash::valid("ingreso exitosamente");
        }
        return Redirect::to();
    }
}