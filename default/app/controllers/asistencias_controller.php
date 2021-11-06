<?php
    Load::models('asistencias');
    class AsistenciasController extends RestController{
        public function get(){

        }
        public function getAll(){

        }
        public function post(){
            // $json =  $this->param();
            // $Alumno = $json["alumno"];
            // foreach($Alumno as $al){
            //     $Asistencia = new Asistencias();
            //     $Asistencia->id_alumno = $al['id_alumno'];
            //     $Asistencia->fecha =  $al['fecha'];
            //     $Asistencia->hora = $al['hora'];
            //     $data["id_alumno"] = $Asistencia['id_alumno'];
            //     $data["fecha"] = $Asistencia['fecha'];
            //     $data["alumno"][] = $Asistencia;  
            // }
            // $this->data = $data;
            $asistencia = new Asistencias();
            if($asistencia->save($this->param())){
                // $this->setCode(201);
                $this->data = $asistencia;
            }else{
                $this->data = $this->error("error inesperado", 400);
            }
        }
    }