<?php

class HistorialMedicoController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('Index'),
                'roles' => array('historialIndex'),
            ),
            array('allow',
                'actions' => array('externoCreate'),
                'roles' => array('historialExternoCreate'),
            ),
            array('allow',
                'actions' => array('PrestacionCreate'),
                'roles' => array('historialPrestacionCreate')
            ),
            array('allow',
                'actions' => array('DetallePrestacion'),
                'roles' => array('historialDetallePrestacion')
            ),
            array('allow',
                'actions' => array('PdfComprobantePrestacion'),
                'roles' => array('historialPdfComprobantePrestacion')
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    public function actionIndex($id_paciente = 0)
    {
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$id_paciente],['historial','indexHistorial']);
        
        $historialModel = $this->loadHistorial($id_paciente);
        $this->render('index',['historialModel'=>$historialModel]);
    }

    private function loadHistorial($id_paciente = 0){
        $pacienteTemp = Paciente::model()->findByPk($id_paciente);
        if($pacienteTemp == null)
            throw new CHttpException(404, 'Ha ocurrido un problema con la solicitud.');
        $historialModel = $pacienteTemp->historialMedico;
        if($historialModel == null)
            throw new CHttpException(404, 'Ha ocurrido un problema con la solicitud.');
        return $historialModel;
    }

    public function actionExternoCreate($id)
    {
        $this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'servicios']);
        $Paciente = Paciente::model()->findByPk($id);
        $this->render('externoCreate', array(
            'Paciente' => $Paciente,
        ));
    }

    public function actionPrestacionCreate()
    {
        $modelPrestacion = new PrestacionServicio();
        $modelPrestacion->id_historial = $_POST['PrestacionServicio']['id_historial'];
        $modelPrestacion->observaciones = $_POST['PrestacionServicio']['observaciones'];
        $modelPrestacion->tipo = $_POST['PrestacionServicio']['tipo'];
        $modelPrestacion->fecha_solicitud = date('d/m/Y h:i:s A');
        $modelPrestacion->save();
        header('Content-Type:application/json;');
        echo CJSON::encode(array('success' => true, 'jsonPrestacion' => $modelPrestacion->id_prestacion));
    }

    public function actionDetallePrestacion()
    {
        $detalles = $_POST['DetallePrestacion'];
        foreach ($detalles as $item):
            $precio = Servicio::model()->findByPk($item['id_servicio']);
            $detalle = new DetallePrestacion();
            $detalle->attributes = $item;
            $detalle->fecha_solicitud = date('d/m/Y h:i:s A');
            $detalle->subtotal = $item['cantidad'] * $precio->precio->monto;
            $detalle->save();
        endforeach;
        $prestacion = PrestacionServicio::model()->findByPk($detalle->id_prestacion);
        $this->redirect(array('PdfComprobantePrestacion', 'id' => $prestacion->id_prestacion));
    }

    public function actionPdfComprobantePrestacion($id)
    {
        $prestacion = PrestacionServicio::model()->findByPk($id);
        $valor = 0;
        foreach ($prestacion->detallePrestacions as $var) {
            $valor = $valor + $var->subtotal;
        }
        $paciente = $prestacion->historial->paciente;
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('I', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle("Reporte Asistencia");
        //cabecera 1 logo santa ana
        $pdf->cabecera1();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario();
        $pdf->cabeceraPaciente($paciente);
        $pdf->titulo('COMPROBANTE DE SERVICIOS');
        $pdf->comprobantePrestacion($prestacion, $valor);
        // reset pointer to the last page
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
    }
}