<?php

Load::models('matriculas');
class MatriculasController extends AppController
{
    public function index($page=1)
    {
        View::template('principal');
        $this->titulo = "Matriculas";
        $matricula = new Matriculas();
        $this->listaMatriculas = $matricula->find();

    }

    //create

    public function create()
    {
        // Flash::info(Input::get('buscar'));

        if (Input::hasPost('buscar')) {
            $buscar = Input::post('buscar');
            $this->matricula = (new Matriculas())->buscar($buscar);
        } else {
            $this->matricula = (new Matriculas());
        }

        View::template('principal');
        $this->titulo = "Matriculas";
        if (Input::hasPost('matriculas')) {
            $matricula = new Matriculas(Input::post('matriculas'));
            if ($matricula->create()) {
                Flash::valid("Matricula creada correctamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("Error, la matricula no fue agregada");
        }
    }

    //edit

    public function edit($id){
        View::template('principal');
        $this->titulo = "Editando matricula";
        $matricula = new Matriculas();
        $this->listaMatriculas = $matricula->find("conditions: id=$id");
        if (Input::hasPost('matriculas')){
            if (!$matricula->update(Input::post('matriculas'))){
                Flash::error("No se pudo editar la matricula");
            }else{
                Flash::valid("Matricula actualizada");
                return Redirect::to();
            }
        }else{
            $this->matriculas = $matricula->find((int) $id);
        }
    }

    //delete

    public function del($id)
    {
        $matricula = new Matriculas();
        if (!$matricula ->delete((int) $id)){
            Flash::error("Error al eleiminar la matricula");
        } else{
            Flash::valid("Matricula borrada");
        }

        return Redirect::to();
    }

    // public function registros(){
    //     View::template('principal');
    //     $this->titulo = "Registro de matriculas";
    // }

    public function barra(){
        View::template('principal');
        $this->titulo = "Codigo de Barras";

        // BUSQUEDA POR AÑO Y SECCION
        if (Input::hasPost('anio') && Input::hasPost('secciones')) {
            $Buscar_anio = Input::post('anio');
            $Buscar_seccion = Input::post('secciones');
            $this->matriculas = (new Matriculas())->seccion_anio($Buscar_seccion, $Buscar_anio);
        } else {
            $this->matriculas = (new Matriculas())->campos();
        }

        // BUSQUEDA POR ESPECIALIDAD Y AÑO
         if (Input::hasPost('especialidad') && Input::hasPost('anio')){
                $Buscar_especialidad = Input::post('especialidad');
                $Buscar_anio = Input::post('anio');
                $this->matriculas = (new Matriculas())->especialidad_anio($Buscar_especialidad, $Buscar_anio); 
        } else {
            $this->matriculas = (new Matriculas())->campos();
        }

        // BUSQUEDA ´POR SECCIONES Y ESPECIALIDAD
        if(Input::hasPost('secciones') && Input::hasPost('especialidad')){
            $Buscar_seccion = Input::post('secciones');
            $Buscar_especialidad = Input::post('especialidad');
            $this->matriculas = (new Matriculas())->seccion_especialidad($Buscar_seccion, $Buscar_especialidad);
        } else {
            $this->matriculas = (new Matriculas())->campos();
        }

        // BUSQUEDA POR ESPECIALIDAD, SECCIONES Y AÑO
        if (Input::hasPost('especialidad') || Input::hasPost('secciones') || Input::hasPost('anio')){
                $Buscar_especialidad = Input::post('especialidad');
                $Buscar_seccion = Input::post('secciones');
                $Buscar_anio = Input::post('anio');
                $this->matriculas = (new Matriculas())->filtros($Buscar_especialidad, $Buscar_seccion, $Buscar_anio);
        } else {
            $this->matriculas = (new Matriculas())->campos();
        }
    }

    // if (Input::hasPost('buscar')) {
    //     $buscar = Input::post('buscar');
    //     $this->matricula = (new Matriculas())->buscar($buscar);
    // } else {
    //     $this->matricula = (new Matriculas());
    // }

    public function pdf_barra(){
        View::template('principal');
        

    //     ob_end_clean();
    //         require_once ('fpdf/fpdf.php');
    //         // require_once ('javascript/jsbarcode.js');
    //         $pdf = new FPDF();
    //         $pdf->AddPage();
    //         $pdf->Ln(5);
    //         $pdf->Image("img/insoimg.png", 12, 10, 28);
    //         $pdf->SetFont('Arial','B',12);
    //         $pdf->Cell(25);
    //         $pdf->Cell(140, 5, "MINISTERIO DE EDUCACION", 0, 1, "C");
    //         $pdf->Cell(185, 5, "INSTITUTO NACIONAL DE SONZACATE", 0, 1, "C");
    //         $pdf->Cell(185, 5, "(I. N. S. O)", 0, 1, "C");
    //         $pdf->SetTitle('listado de codigo de barras');
    //         $pdf->SetFont("Arial", "", 12);
    //         $pdf->Cell(185, 5, "Ficha de Matricula ".date('Y'), 0, 1, "C");
    //         $pdf->SetFont("Arial", "B", 11);
    //         $pdf->Cell(80, 6, "Nombre del estudiante", 1, 0, "C");
    //         $pdf->SetFont("Arial", "B", 11);
    //         $pdf->Cell(100, 6, "Especialidad", 1, 1, "C");

    //         foreach ($listaMatriculas4 as $item){
    //             $pdf->SetFont("Arial", "", 11);
    //             $pdf->Cell(80, 6, utf8_decode($item->getAlumnos()->primer_nombre.' '.$item->getAlumnos()->segundo_nombre.' '.$item->getAlumnos()->primer_apellido.' '.$item->getAlumnos()->segundo_apellido), 1, 0, "C");
                    
    //             // Especialidad
                
    //             $pdf->SetFont("Arial", "", 11);
    //             $pdf->Cell(100, 6, utf8_decode($item->getEspecialidades()->nombre_especialidad), 1, 1, "C");
    //         }
            
    //         $pdf->Ln(4);
    //         $pdf->Output('','listado de codigo de barras.pdf',true);
            
    //         ob_end_flush();
    }
}
?>