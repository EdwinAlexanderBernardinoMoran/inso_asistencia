<?php
    Load::models('asistencias');
    class AsistenciasController extends RestController{
        public function get($id){
            $asistencia = new Asistencias();
            $this->data = $asistencia->find("conditions: id_alumno=$id");
        }
        public function getAll(){
            $asistencia = new Asistencias();
            $this->data = $asistencia->find();
        }
        public function post(){
            $asistencia = new Asistencias();
            if($asistencia->save($this->param())){
                $this->data = $asistencia;
            }else{
                $this->data = $this->error("error inesperado", 400);
            }
        }
    }