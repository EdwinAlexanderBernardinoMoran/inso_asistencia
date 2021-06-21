<?php 
Load::models('cantones');
class CantonesController extends AppController
{
    public function index($page=1){
        view::template('principal');
        $this->titulo="cantones";
        $canton = new Cantones();
        $this->$ListCantones = $canton->getCantones($page);
    }
    /**
  * create
  */
  public function create(){
      $this->titulo = "cantones";
      view::template('principal');
      if (Input::hasPost('cantones')){
          $canton = new Cantones(Input::post('cantones'));
          if (!$canton->create()){
              flash::valid("creado exitosamente")
              Inpup::delate();
              return
          }
          flash::error("fallo la operacion")
      }
  }

}