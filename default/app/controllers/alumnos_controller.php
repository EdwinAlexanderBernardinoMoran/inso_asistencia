<?php 

require_once APP_PATH . '../../vendor/autoload.php';


Load::models('alumnos');

class AlumnosController extends AppController{
    public function index($page=1){
        View::template('principal');
        $this->titulo = "Alumnos";
        $alumno = new Alumnos();
        $this->listaAlumnos = $alumno->getAlumnos($page);
    }

    public function pdf($id)
    {
        require 'connection.php';

        ob_end_clean();
        require_once ('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image("img/insoimg.png", 12, 5, 25);
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(25);
        $pdf->Cell(140, 5, "MINISTERIO DE EDUCACION", 0, 1, "C");
        $pdf->Cell(185, 5, "INSTITUTO NACIONAL DE SONZACATE", 0, 1, "C");
        $pdf->SetTitle('Ficha de matricula');
        $pdf->SetFont("Arial", "", 12);
        $pdf->Cell(185, 5, "Ficha de Matricula ".date('Y'), 0, 1, "C");
        
        $pdf->Ln(4);
        $pdf->SetFont("Arial", "B", 13);
        $pdf->Cell(65, 5, "Identificacion del estudiante:", 0, 1, "C");
        $pdf->SetFont("Arial", "", 10);

        $pdf->Ln(8);

        


        $pdf->SetFont("Arial", "", 9);
        $sql = "SELECT alumnos.id, alumnos.primer_nombre, alumnos.segundo_nombre, alumnos.primer_apellido, alumnos.segundo_apellido, alumnos.fecha_nacimiento, nacionalidades.nombre_nacionalidad, departamentos.nombre_departamento, municipios.nombre_municipio, alumnos.anio_bachillerato, alumnos.nie, alumnos.numero_partida, alumnos.folio_partida, alumnos.libro_partida, alumnos.otro_documento_de_identificacion, alumnos.salvadoreno_por, especialidades.nombre_especialidad, alumnos.estudio_parvularia, alumnos.repite_grado, centroescolares.nombre_centroescolar, alumnos.anio_anterior, alumnos.tipo_de_sangre, alumnos.sexo, alumnos.estado_familiar, alumnos.discapacidad, alumnos.email, alumnos.telefono_fijo, alumnos.celular, zonas.nombre_zona, cantones.nombre_canton, caserios.nombre_caserio, alumnos.tipo_de_calle, alumnos.direccion_completa, alumnos.medio_de_transporte, alumnos.distancia_desde_casa_y_centroeducativo, alumnos.factor_de_riesgo, alumnos.numero_integrantes_familia, alumnos.integrados, alumnos.depende_economicamente_de, alumnos.tiene_hijos, alumnos.trabaja, alumnos.convivencia_con, alumnos.nombre_madre, alumnos.ocupacion_madre, alumnos.lugar_de_trabajo_madre, alumnos.telefono_madre, alumnos.nombre_padre, alumnos.ocupacion_padre, alumnos.lugar_de_trabajo_padre, alumnos.telefono_padre FROM alumnos, nacionalidades, departamentos, municipios, especialidades, centroescolares, zonas, cantones, caserios WHERE alumnos.id='$id' and alumnos.id_nacionalidad=nacionalidades.id and alumnos.id_departamento_de_nacimiento=departamentos.id and alumnos.id_municipio_de_nacimiento=municipios.id and alumnos.id_especialidad_ingreso=especialidades.id and alumnos.id_centro_escolar_providencia=centroescolares.id and alumnos.id_zona=zonas.id and alumnos.id_departamento_residencia=departamentos.id and alumnos.id_municipio_residencia=municipios.id and alumnos.id_canton=cantones.id and alumnos.id_caserio=caserios.id";
            $resultado = mysqli_query($conn, $sql);

            // while ($fila = $resultado->fetch_assoc())
            while ($item = mysqli_fetch_array($resultado)){
                // FILA 1
                $pdf->SetFont("Arial", "B", 9);

                $pdf->Cell(45, 5, "Primer nombre", 0, 0, "C");
        $pdf->Cell(45, 5, "Segundo nombre", 0, 0, "C");
        $pdf->Cell(45, 5, "Primer apellido", 0, 0, "C");
        $pdf->Cell(45, 5, "Segundo apellido", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(45, 5, $item['primer_nombre'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['segundo_nombre'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['primer_apellido'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['segundo_apellido'], 0, 1, "C");

        // FILA 2
        $pdf->Ln(5);
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Cell(48, 5, "Fecha nacimiento", 0, 0, "C");
        $pdf->Cell(45, 5, "Nacionalidad", 0, 0, "C");
        $pdf->Cell(45, 5, "Departamento de Nac.", 0, 0, "C");
        $pdf->Cell(45, 5, "Municipio de Nac.", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(45, 5, $item['fecha_nacimiento'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['nombre_nacionalidad'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['nombre_departamento'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['nombre_municipio'], 0, 1, "C");

        // FILA 3
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(53, 5, "Anio de bachillerato", 0, 0, "C");
        $pdf->Cell(30, 5, "Nie", 0, 0, "C");
        $pdf->Cell(20, 5, "# Partida.", 0, 0, "C");
        $pdf->Cell(45, 5, "Folio de partida", 0, 0, "C");
        $pdf->Cell(35, 5, "Libro de partida", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(53, 5, $item['anio_bachillerato'], 0, 0, "C");
        $pdf->Cell(30, 5, $item['nie'], 0, 0, "C");
        $pdf->Cell(20, 5, $item['numero_partida'], 0, 0, "C");
        $pdf->Cell(45, 5, $item['folio_partida'], 0, 0, "C");
        $pdf->Cell(35, 5, $item['libro_partida'], 0, 1, "C");

        // FILA 4
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, "Documento identificacion", 0, 0, "C");
        $pdf->Cell(65, 5, "Salvadoreno por", 0, 0, "C");
        $pdf->Cell(65, 5, "Especialidad", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(60, 5, $item['otro_documento_de_identificacion'], 0, 0, "C");
        $pdf->Cell(65, 5, $item['salvadoreno_por'], 0, 0, "C");
        $pdf->Cell(65, 5, $item['nombre_especialidad'], 0, 0, "C");

        // FILA 6
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(8);
        $pdf->Cell(47, 5, "Estudio parvularia", 0, 0, "C");
        $pdf->Cell(60, 5, "Repite grado", 0, 0, "C");
        $pdf->Cell(70, 5, "Centro de procedencia", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(47, 5, $item['estudio_parvularia'], 0, 0, "C");
        $pdf->Cell(60, 5, $item['repite_grado'], 0, 0, "C");
        $pdf->Cell(70, 5, $item['nombre_centroescolar'], 0, 1, "C");

        // FILA 7
        $pdf->Ln(3);
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Cell(70, 5, "Anio que estudio anteriormente", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(70, 5, $item['anio_anterior'], 0, 1, "C");

        // ---------------------------------------------------
        // INFORMACION DEL ESTUDIANTE
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "B", 13);
        $pdf->Cell(65, 5, "Informacion del estudiante:", 0, 1, "C");

        // FILA 1
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(50, 5, "Tipo de sangre", 0, 0, "C");
        $pdf->Cell(50, 5, "Sexo", 0, 0, "C");
        $pdf->Cell(50, 5, "Estado familiarr.", 0, 0, "C");
        $pdf->Cell(50, 5, "Discapacidad", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(50, 5, $item['tipo_de_sangre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['sexo'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['estado_familiar'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['discapacidad'], 0, 1, "C");

        // ------------------------------------------------------------
        // DATOS DE CONTACTO
        $pdf->Ln(7);
        $pdf->SetFont("Arial", "B", 13);
        $pdf->Cell(48, 5, "Datos de contacto:", 0, 1, "C");

        // FILA 1
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(8);
        $pdf->Cell(50, 5, "Correo electronico", 0, 0, "C");
        $pdf->Cell(50, 5, "Tel. fijo", 0, 0, "C");
        $pdf->Cell(50, 5, "Celular", 0, 0, "C");
        $pdf->Cell(50, 5, "Residencia", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(50, 5, $item['email'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['telefono_fijo'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['celular'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['nombre_zona'], 0, 1, "C");

        // FILA 2
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(45, 5, "Departamento", 0, 0, "C");
        $pdf->Cell(50, 5, "Municipio", 0, 0, "C");
        $pdf->Cell(50, 5, "Canton", 0, 0, "C");
        $pdf->Cell(50, 5, "Caserio", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(45, 5, $item['nombre_departamento'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['nombre_municipio'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['nombre_canton'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['nombre_caserio'], 0, 1, "C");

        // FILA 3
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(40, 5, "Tipo de calle", 0, 0, "C");
        $pdf->Cell(80, 5, "Direccion completa del estudiante", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(40, 5, $item['tipo_de_calle'], 0, 0, "C");
        $pdf->Cell(80, 5, $item['direccion_completa'], 0, 1, "C");

        // ---------------------------------------------------------
        // OTROS DATOS
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "B", 13);
        $pdf->Cell(38, 5, "Otros datos:", 0, 1, "C");

        // FILA 1
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(75, 5, "Medio de transporte que utilizas", 0, 0, "C");
        $pdf->Cell(120, 5, "Distancia en kilometros al centro educativo", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(75, 5, $item['medio_de_transporte'], 0, 0, "C");
        $pdf->Cell(120  , 5, $item['distancia_desde_casa_y_centroeducativo'], 0, 1, "C");

        // FILA 2
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(50, 5, "Factor de riesgo", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(45, 5, $item['factor_de_riesgo'], 0, 1, "C");

        // ---------------------------------------------------------
        // GRUPO FAMILIAR
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "B", 13);
        $pdf->Cell(38, 5, "Grupo familiar:", 0, 1, "C");

        // FILA 1
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(5);
        $pdf->Cell(50, 5, "# De integrantes de la familia", 0, 0, "C");
        $pdf->Cell(50, 5, "Integrados", 0, 0, "C");
        $pdf->Cell(50, 5, "Depende economicamente de", 0, 0, "C");
        $pdf->Cell(50, 5, "Tiene hijos", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(50, 5, $item['numero_integrantes_familia'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['integrados'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['depende_economicamente_de'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['tiene_hijos'], 0, 1, "C");
        
        // FILA 2
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(3);
        $pdf->Cell(50, 5, "Trabaja", 0, 0, "C");
        $pdf->Cell(50, 5, "Convivencia con", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(50, 5, $item['trabaja'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['convivencia_con'], 0, 1, "C");

        // FILA 3
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(3);
        $pdf->Cell(45, 5, "Nombre de la madre", 0, 0, "C");
        $pdf->Cell(50, 5, "Ocupacion", 0, 0, "C");
        $pdf->Cell(50, 5, "Lugar de trabajo", 0, 0, "C");
        $pdf->Cell(50, 5, "Telefono", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(45, 5, $item['nombre_madre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['ocupacion_madre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['lugar_de_trabajo_madre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['telefono_madre'], 0, 1, "C");

        // FILA 3
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Ln(3);
        $pdf->Cell(45, 5, "Nombre del padre", 0, 0, "C");
        $pdf->Cell(50, 5, "Ocupacion", 0, 0, "C");
        $pdf->Cell(50, 5, "Lugar de trabajo", 0, 0, "C");
        $pdf->Cell(50, 5, "Telefono", 0, 1, "C");
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(45, 5, $item['nombre_padre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['ocupacion_padre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['lugar_de_trabajo_padre'], 0, 0, "C");
        $pdf->Cell(50, 5, $item['telefono_padre'], 0, 1, "C");
            }
        $pdf->Output();
        ob_end_flush();
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

    public function barra(){
        View::template('principal');
        $this->titulo = "Codigo de Barras";
    }
}

?>