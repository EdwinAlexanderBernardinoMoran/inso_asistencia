<?php 

require_once APP_PATH . '../../vendor/autoload.php';
// require_once CORE_PATH.'vendor/autoload.php';


Load::models('alumnos');

class AlumnosController extends AppController{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Alumnos";
        $alumno = new Alumnos();
        $this->listaAlumnos = (new Alumnos)->find();
    }

    

    //REGISTRO DE ALUMNOS

    public function create (){
        View::template('principal');
        $this->titulo="Registro de alumnos";
        if (Input::hasPost('alumnos')){
            $alumno = new Alumnos(Input::post('alumnos'));
            // print_r($alumno);
            // return;
            if (!$alumno->create()){
                Flash::error('Fallo la operacion');
            }else{
                Flash::valid("Alumno registrado exitosamente");
                Input::delete();
                return Redirect::to();
            }
        }
    }

    // BOTON DE EDITAR UN REGISTROS
    public function edit($id){
        View::template('principal');
        $this->titulo="Actualizando datos del alumno";
        $alumno = new Alumnos();
        if(Input::hasPost('alumnos')){
            if (!$alumno->update(Input::post('alumnos'))) {
                Flash::error("No se actualizao el registro");
            } else{
                Flash::valid("Datos del alumno actualizados");
                return Redirect::to();
            }
        } else {
            $this->alumnos = $alumno->find((int) $id);
        }
    }

    public function del($id){
        $alumno = new Alumnos();
        if(!$alumno->delete((int)$id)){
            Flash::error("No se apodido eliminar el alumno");
        }else{
            Flash::valid("Alumno eliminado con exito");
        }
        return Redirect::to();
    }

    public function pdf($id)
    {   
        $alumno = new Alumnos();
        $listaAlumnos = $this->listaAlumnos = $alumno->find("conditions: id=$id");
        ob_end_clean();
        require_once ('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Ln(5);
        $pdf->Image("img/insoimg.png", 12, 10, 28);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(25);
        $pdf->Cell(140, 5, "MINISTERIO DE EDUCACION", 0, 1, "C");
        $pdf->Cell(185, 5, "INSTITUTO NACIONAL DE SONZACATE", 0, 1, "C");
        $pdf->Cell(185, 5, "(I. N. S. O)", 0, 1, "C");
        $pdf->SetTitle('Ficha de matricula');
        $pdf->SetFont("Arial", "", 12);
        $pdf->Cell(185, 5, "Ficha de Matricula ".date('Y'), 0, 1, "C");
        
        $pdf->Ln(4);
        $pdf->SetFont("Arial", "B", 12);
        $pdf->Cell(60, 5, utf8_decode("Identificación del estudiante:"), 0, 1, "C");
        $pdf->SetFont("Arial", "", 10);

        $pdf->Ln(5);

        $pdf->SetFont("Arial", "", 9);
        foreach ($listaAlumnos as $item){
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Nombre del estudiante", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(140, 6, utf8_decode($item->primer_nombre.' '.$item->segundo_nombre.' '.$item->primer_apellido.' '.$item->segundo_apellido), 1, 1, "C");
            // Fecha de nacimiento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Fecha de nacimiento", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(40, 6, $item->fecha_nacimiento, 1, 0, "C");
            // nacionalidad
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Nacionalidad:", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(50, 6, utf8_decode($item->getNacionalidad()->nombre_nacionalidad), 1, 1, "C");


            // FILA 2
            // departamento de nacimiento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Departamento de Nac.", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(47, 6, utf8_decode($item->getDepartamentonacimiento()->nombre_departamento), 1, 0, "C");
            // municipio de nacimiento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(43, 6, "Municipio de Nac.", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(50, 6, utf8_decode($item->getMunicipionacimiento()->nombre_municipio), 1, 1, "C");

            // FILA 3
            // año de bachillerato
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, utf8_decode("Año de bachillerato"), 1, 0, "C");
            $pdf->SetFont("Arial", "", 10);
            $pdf->Cell(47, 6, utf8_decode($item->anio_bachillerato), 1, 0, "C");
            // nie
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(43, 6, "Nie:", 1, 0, "C");
            $pdf->SetFont("Arial", "", 10);
            $pdf->Cell(50, 6, $item->nie, 1, 1, "C");

            // FILA 4
            // partida de nacimiento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "# Partida.", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(23, 6, $item->numero_partida, 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Folio de partida", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(23, 6, $item->folio_partida, 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Libro de partida", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(24, 6, $item->libro_partida, 1, 1, "C");

            // FILA 5
            // otro documento de identificacion
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(60, 6, "Otro documento identificacion", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(45, 6, utf8_decode($item->otro_documento_de_identificacion), 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(45, 6, "Salvadoreno por", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(40, 6, utf8_decode($item->salvadoreno_por), 1, 1, "C");

            // FILA 6
            // Especialidad
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(55, 6, "Especialidad", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(135, 6, utf8_decode($item->getEspecialidades()->nombre_especialidad), 1, 1, "C");

            // FILA 7
            // Centro de procedencia
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Centro de procedencia", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(140, 6, utf8_decode($item->getCentroescolares()->nombre_centroescolar), 1, 1, "C");

            // Estudio estudio_parvularia
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Estudio parvularia", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(10, 6, utf8_decode($item->estudio_parvularia), 1, 0, "C");
            // Repite grado
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Repite grado", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(10, 6, $item->repite_grado, 1, 0, "C");

            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(70, 6, utf8_decode("Año que estudio anteriormente"), 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(20, 6, $item->anio_anterior, 1, 1, "C");

            // ---------------------------------------------------
            // INFORMACION DEL ESTUDIANTE
            $pdf->Ln(10);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(60, 5, utf8_decode("Información del estudiante:"), 0, 1, "C");

            // FILA 1
            // Tipo de sangre
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Ln(5);
            $pdf->Cell(45, 6, "Tipo de sangre", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(55, 6, utf8_decode($item->tipo_de_sangre), 1, 0, "C");
            // sexo
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Sexo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->sexo == 'M'){
                echo $pdf->Cell(50, 6, "Masculino", 1, 1, "C");
            }
            if ($item->sexo == 'F'){
                echo $pdf->Cell(50, 6, "Femenino", 1, 1, "C");
            }

            // FILA 2
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(45, 6, "Estado familiar", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if (utf8_decode($item->estado_familiar) == 'C'){
                echo $pdf->Cell(45, 6, "Casado/a", 1, 0, "C");
            }
            if (utf8_decode($item->estado_familiar) == 'V'){
                echo $pdf->Cell(45, 6, "Viudo/a", 1, 0, "C");
            }
            if (utf8_decode($item->estado_familiar) == 'D'){
                echo $pdf->Cell(45, 6, "Divorciado/a", 1, 0, "C");
            }
            if (utf8_decode($item->estado_familiar) == 'S'){
                echo $pdf->Cell(45, 6, "Soltero/a", 1, 0, "C");
            }
            if (utf8_decode($item->estado_familiar) == 'A'){
                echo $pdf->Cell(45, 6, "Acompañado/a", 1, 0, "C");
            }
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Discapacidad", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(60, 6, utf8_decode($item->discapacidad), 1, 1, "C");

            // ------------------------------------------------------------
            // DATOS DE CONTACTO
            $pdf->Ln(7);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(42, 5, "Datos de contacto:", 0, 1, "C");

            // FILA 1
            // Correo electronico
            $pdf->Ln(8);
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(45, 6, "Correo electronico", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 6, utf8_decode($item->email), 1, 1, "C");


            // FILA 2
            // Telefono fijo
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Tel. fijo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(35, 6, $item->telefono_fijo, 1, 0, "C");
            // Telefono celular
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Celular", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(35, 6, $item->celular, 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Zona", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(30, 6, utf8_decode($item->getZonacontacto()->nombre_zona), 1, 1, "C");
            

            // FILA 3
            // departamento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(45, 6, "Departamento", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(45, 6, utf8_decode($item->getDepartamentoresidencia()->nombre_departamento), 1, 0, "C");
            // municipio
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Municipio", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(50, 6, utf8_decode($item->getMunicipioresidencia()->nombre_municipio), 1, 1, "C");

            // FILA 4
            // canton
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Canton", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(150, 6, utf8_decode($item->getCantonresidencia()->nombre_canton), 1, 1, "C");

            // FILA 5
            // caserio
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(25, 6, "Caserio", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(75, 6, utf8_decode($item->getCaserioresidencia()->nombre_caserio), 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Tipo de calle", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(40, 6, utf8_decode($item->tipo_de_calle), 1, 1, "C");
            

            // FILA 6
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(70, 6, "Direccion completa del estudiante", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(120, 6, utf8_decode($item->direccion_completa), 1, 1, "C");

            // ---------------------------------------------------------
            // OTROS DATOS
            $pdf->Ln(8);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(28, 5, "Otros datos:", 0, 1, "C");

            // FILA 1
            // Medio de transporte
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Ln(5);
            $pdf->Cell(70, 6, "Medio de transporte que utilizas", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(120, 6, utf8_decode($item->medio_de_transporte), 1, 1, "C");

            // FILA 2
            // Distancia en kilometros de el centro educativo.
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(90, 6, utf8_decode("Distancia en kilometros al centro educativo"), 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(100, 6, $item->distancia_desde_casa_y_centroeducativo, 1, 1, "C");

            // FILA 3
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Factor de riesgo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(155, 6, utf8_decode($item->factor_de_riesgo), 1, 1, "C");

            // ---------------------------------------------------------
            // GRUPO FAMILIAR
            $pdf->Ln(8);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(32, 5, "Grupo familiar:", 0, 1, "C");

            // FILA 1
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Ln(5);
            $pdf->Cell(80, 5, "# De integrantes de la familia", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(25, 5, $item->numero_integrantes_familia, 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(60, 5, "Integrados", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(25, 5, $item->integrados, 1, 1, "C");

            // FILA 2
            // Depende economicamente de
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(60, 6, "Depende economicamente de", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(40, 6, utf8_decode($item->depende_economicamente_de), 1, 0, "C");
            // Tiene hijos
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Tiene hijos", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(15, 6, $item->tiene_hijos, 1, 0, "C");
            // Trabaja
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Trabaja", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(15, 6, $item->trabaja, 1, 1, "C");


            // FILA 3
            // Convivencia con
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Convivencia con", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(35, 6, utf8_decode($item->convivencia_con), 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Nombre de la madre", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(80, 6, utf8_decode($item->nombre_madre), 1, 1, "C");

            // FILA 4
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Lugar de trabajo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(155, 6, utf8_decode($item->lugar_de_trabajo_madre), 1, 1, "C");

            // FILA 5
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Ocupacion", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(65, 6, utf8_decode($item->ocupacion_madre), 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Telefono", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(50, 6, $item->telefono_madre, 1, 1, "C");

            
            // FILA 6
            // Nombre del padre
            
            $pdf->Ln(5);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(188, 5, "MINISTERIO DE EDUCACION", 0, 1, "C");
            $pdf->Cell(185, 5, "INSTITUTO NACIONAL DE SONZACATE", 0, 1, "C");
            $pdf->Cell(185, 5, "(I. N. S. O)", 0, 1, "C");
            $pdf->SetTitle('Ficha de matricula');
            $pdf->SetFont("Arial", "", 12);
            $pdf->Cell(185, 5, "Ficha de Matricula ".date('Y'), 0, 1, "C");
            $pdf->Ln(10);

            
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Nombre del padre", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(155, 6, utf8_decode($item->nombre_padre), 1, 1, "C");
            // Lugar de trabajo del padre
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Lugar de trabajo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(155, 6, utf8_decode($item->lugar_de_trabajo_padre), 1, 1, "C");
            // Ocupacion del padre
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Ocupacion", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(65, 6, utf8_decode($item->ocupacion_padre), 1, 0, "C");
            // Telefono del padre
            $pdf->SetFont("Arial", "B", 11);

            $pdf->Cell(40, 6, "Telefono", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(50, 6, $item->telefono_padre, 1, 1, "C");

             // IDENTIFICACION DEL RESPONSABLE
             $pdf->Ln(5);
             $pdf->SetFont("Arial", "B", 12);
             $pdf->Cell(65, 5, utf8_decode("Identificacion Del Responsable:"), 0, 1, "C");

             $pdf->Ln(5);
            //  FILA 1
            //  Nombre del responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Nombre del responsable", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(140, 6, utf8_decode($item->primer_nombre_responsable.' '.$item->segundo_nombre_responsable.' '.$item->primer_apellido_responsable.' '.$item->segundo_apellido_responsable), 1, 1, "C");

            // FILA 2
            // Numero de dui del responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Numero de dui", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(45, 6, $item->numero_dui_responsable, 1, 0, "C");
            // Estado familiar del responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Estado familiar", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->estado_familiar_responsable == 'C'){
                echo $pdf->Cell(45, 6, utf8_decode("Casado/a"), 1, 1, "C");
            }
            if ($item->estado_familiar_responsable == 'V'){
                echo $pdf->Cell(45, 6, utf8_decode("Viudo/a"), 1, 1, "C");
            }
            if ($item->estado_familiar_responsable == 'D'){
                echo $pdf->Cell(45, 6, utf8_decode("Divorciado/a"), 1, 1, "C");
            }
            if ($item->estado_familiar_responsable == 'S'){
                echo $pdf->Cell(45, 6, utf8_decode("Soltero/a"), 1, 1, "C");
            }
            if ($item->estado_familiar_responsable == 'A'){
                echo $pdf->Cell(45, 6, utf8_decode("Acompañado/a"), 1, 1, "C");
            }

            // DATOS DEL RESPONSABLE
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(48, 5, "Datos Del Responsable:", 0, 1, "C");

            // FILA 1
            // Correo electronico
            $pdf->Ln(8);
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(45, 6, "Correo electronico", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 6, $item->email_responsable, 1, 1, "C");


            // FILA 2
            // Telefono fijo
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Tel. fijo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(35, 6, $item->telefono_fijo_encargado, 1, 0, "C");
            // Telefono celular
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Celular", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(35, 6, $item->celular_encargado, 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(30, 6, "Zona", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(30, 6, utf8_decode($item->getZonaencargado()->nombre_zona), 1, 1, "C");
            

            // FILA 3
            // departamento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(45, 6, "Departamento", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(45, 6, utf8_decode($item->getDepartamentoencargado()->nombre_departamento), 1, 0, "C");
            // municipio
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Municipio", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(50, 6, utf8_decode($item->getMunicipioencargado()->nombre_municipio), 1, 1, "C");

            // FILA 4
            // canton
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Canton", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(150, 6, utf8_decode($item->getCantonencargado()->nombre_canton), 1, 1, "C");

            // FILA 5
            // caserio
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(25, 6, "Caserio", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(75, 6, utf8_decode($item->getCaserioencargado()->nombre_caserio), 1, 0, "C");
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(50, 6, "Tipo de calle", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(40, 6, utf8_decode($item->tipo_de_calle_responsable), 1, 1, "C");
            

            // FILA 6
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(70, 6, utf8_decode("Dirección completa del estudiante"), 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(120, 6, utf8_decode($item->direccion_completa_responsable), 1, 1, "C");

            // OTROS DATOS DEL RESPONSABLE
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(61, 5, "Otros Datos Del Responsable:", 0, 1, "C");

            $pdf->Ln(8);

            // FILA 1
            // Profesion o oficio del responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "profesion u oficio", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(35, 6, utf8_decode($item->profesion_oficio_responsable), 1, 0, "C");
            // Celular responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(20, 6, "Celular", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(25, 6, $item->celular_responsable, 1, 0, "C");
            // Escolaridad responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Escolaridad", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(40, 6, utf8_decode($item->escolaridad_responsable), 1, 1, "C");

            // FILA 2
            // Factor de riesgo responsable
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(35, 6, "Factor de riesgo", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(65, 6, utf8_decode($item->factor_de_riesgo_responsable), 1, 0, "C");
            // Fecha revision formulario
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(65, 6, utf8_decode("Fecha De Revisión del Formulario"), 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(25, 6, $item->fecha_revision_formulario, 1, 1, "C");

            // OTROS DATOS DEL RESPONSABLE
            $pdf->Ln(7);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(108, 5, "Reservado Para El Profesor Que Realizo La Matricula:", 0, 1, "C");

            $pdf->Ln(8);
            // FILA 1
            // Partida de nacimiento
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(53, 6, "Partida de nacimiento", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->partida_nacimiento == 0){
                echo $pdf->Cell(11, 6, "NO", 1, 0, "C");
            }
            if ($item->partida_nacimiento == 1){
                echo $pdf->Cell(11, 6, "SI", 1, 0, "C");
            }
            // Certificado de notas
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(53, 6, "Certificado de notas", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->certificacion_de_notas == 0){
                echo $pdf->Cell(11, 6, "NO", 1, 0, "C");
            }
            if ($item->certificacion_de_notas == 1){
                echo $pdf->Cell(11, 6, "SI", 1, 0, "C");
            }
            // $pdf->Cell(11, 6, $item->certificacion_de_notas, 1, 0, "C");
            // Certififcado
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(51, 6, "Certificado", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->certificado == 0){
                echo $pdf->Cell(11, 6, "NO", 1, 1, "C");
            }
            if ($item->certificado == 1){
                echo $pdf->Cell(11, 6, "SI", 1, 1, "C");
            }
            // $pdf->Cell(11, 6, $item->certificado, 1, 1, "C");

            // FILA 2
            // Fotos
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(27, 6, "Fotos", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->fotos == 0){
                echo $pdf->Cell(11, 6, "NO", 1, 0, "C");
            }
            if ($item->fotos == 1){
                echo $pdf->Cell(11, 6, "SI", 1, 0, "C");
            }
            // $pdf->Cell(11, 6, $item->fotos, 1, 0, "C");
            // Fotocopia de dui
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Fotocopia de dui", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->fotocopia_dui == 0){
                echo $pdf->Cell(11, 6, "NO", 1, 0, "C");
            }
            if ($item->fotocopia_dui == 1){
                echo $pdf->Cell(11, 6, "SI", 1, 0, "C");
            }
            // $pdf->Cell(11, 6, $item->fotocopia_dui, 1, 0, "C");
            // Constancia de conducta
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Fotocopia de dui", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->constancia_de_conducta == 0){
                echo $pdf->Cell(11, 6, "NO", 1, 0, "C");
            }
            if ($item->constancia_de_conducta == 1){
                echo $pdf->Cell(11, 6, "SI", 1, 0, "C");
            }
            // $pdf->Cell(11, 6, $item->constancia_de_conducta, 1, 0, "C");

            // FILA 3
            // Carnet de residente
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Carnet Residente", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            if ($item->carnet_residente == 0){
                echo $pdf->Cell(10, 6, "NO", 1, 1, "C");
            }
            if ($item->carnet_residente == 1){
                echo $pdf->Cell(10, 6, "SI", 1, 1, "C");
            }
            // $pdf->Cell(10, 6, $item->carnet_residente'], 1, 1, "C");

            // Profesor que realiz la matricula
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(40, 6, "Nombre Del Profesor", 1, 0, "C");
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(150, 6, utf8_decode($item->getNombresprofesores()->primer_nombre_profesor.' '.$item->getNombresprofesores()->segundo_nombre_profesor.' '.$item->getNombresprofesores()->primer_apellido_profesor.' '.$item->getNombresprofesores()->segundo_apellido_profesor), 1, 1, "C");

            }

        $pdf->Output('','ficha de matricula.pdf',true);
        ob_end_flush();
    }
}

?>