<?php 

class Alumnos extends ActiveRecord{

    public function initialize(){
        $this->belongs_to('Especialidades', 'model: Especialidades', 'fk: id_especialidad_ingreso');
        $this->belongs_to('Departamentonacimiento', 'model: Departamentos', 'fk: id_departamento_de_nacimiento');
        $this->belongs_to('Nacionalidad', 'model: Nacionalidades', 'fk: id_nacionalidad');
        $this->belongs_to('Municipionacimiento', 'model: Municipios', 'fk: id_municipio_de_nacimiento');
        $this->belongs_to('Zonacontacto', 'model: Zonas', 'fk: id_zona');
        $this->belongs_to('Departamentoresidencia', 'model: Departamentos', 'fk: id_departamento_residencia');
        $this->belongs_to('Municipioresidencia', 'model: Municipios', 'fk: id_municipio_residencia');
        $this->belongs_to('Cantonresidencia', 'model: Cantones', 'fk: id_canton');
        $this->belongs_to('Caserioresidencia', 'model: Caserios', 'fk: id_caserio');
        $this->belongs_to('Zonaencargado', 'model: Zonas', 'fk: id_zona_responsable');
        $this->belongs_to('Departamentoencargado', 'model: Departamentos', 'fk: id_departamento_responsable');
        $this->belongs_to('Municipioencargado', 'model: Municipios', 'fk: id_municipio_responsable');
        $this->belongs_to('Cantonencargado', 'model: Cantones', 'fk: id_canton_responsable');
        $this->belongs_to('Caserioencargado', 'model: Caserios', 'fk: id_caserio_responsable');
        $this->belongs_to('Centroescolares', 'model: Centroescolares', 'fk: id_centro_escolar_providencia');
        $this->belongs_to('Nombresprofesores', 'model: Profesores', 'fk: id_profesor_revision');
    }

    public function getAlumnos($page, $ppage=20){
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }
    
    // public function getAlumno(){
    //     return $this->find();
    // }
}

?>