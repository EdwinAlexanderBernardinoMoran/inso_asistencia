
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

    public function registros(){
        View::template('principal');
        $this->titulo = "Registro de matriculas";
    }

    public function barra(){
        View::template('principal');
        $this->titulo = "Codigo de Barras";
    }

    public function pdf_barra($Buscar_especialidad = NULL, $Buscar_seccion = NULL, $Buscar_anio = NULL){
        View::template('principal');
        $this->titulo = "Listado de alumnos con codigo de barra";

        ob_end_clean();
        require_once ('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Ln(5);
        $pdf->Image("img/insoimg.png", 12, 10, 28);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(25);
        $pdf->Cell(140, 5, "INSTITUTO NACIONAL DE SONZACATE", 0, 1, "C");
        $pdf->Cell(185, 5, "(I. N. S. O)", 0, 1, "C");
        $pdf->SetTitle('Listado de alumnos con codigo de barra');
        $pdf->SetFont("Arial", "", 12);
        
        $pdf->Ln(4);
        $pdf->Output('','ficha de matricula.pdf',true);
        ob_end_flush();
    }
}
?>
