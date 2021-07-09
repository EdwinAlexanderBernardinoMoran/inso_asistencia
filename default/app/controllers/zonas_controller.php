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
    public function create (){
        View::template('principal');
        $this->titulo="zonas";
        if (Input::hasPost('zonas')){
            $zona = new Zonas(Input::post('zonas'));
            if ($zona->save()){
                Flash::valid("Zona creada exitosamente");
                Input::delete();
                return;
            }
            Flash::error("Fallo al crear la zona");
        }
    }
    /**
     * edit
     */
    public function edit($id){
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
        } else {
            $this->zonas = $zona->find((int)$id); 
        }
    }
    /**
     * delete
     */
    public function del($id){
        $zona = new Zonas();
        if(!$zona->delete((int)$id)){
            Flash::error("error al ingresar la zona");
        }else{
            Flash::valid("ingreso con exito");
        }
        return Redirect::to();
    }
}