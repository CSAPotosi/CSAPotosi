<?php

class CitaController extends Controller
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
                'actions' => array('IndexCita'),
                'roles' => array('citaIndex'),
            ),
            array('allow',
                'actions' => array('Update'),
                'roles' => array('citaUpdate'),
            ),
            array('allow',
                'actions' => array('PdfComprobanteCita'),
                'roles' => array('citaPdfComprobanteCita'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    public function actionIndexCita($id = null)
    {
        if ($id != null)
            $paciente = Paciente::model()->findByPk($id);
        else
            $paciente = '';
        $listPacientes = Paciente::model()->findAll();
        $listAtencionMedica = ServAtencionMedica::model()->findAll();
        $listCitas = Cita::model()->findAll();
        $modelCita = new Cita();
        if (isset($_POST['Cita'])) {
            if ($id != null)
                $paciente = Paciente::model()->findByPk($id);
            else
                $paciente = '';
            $modelCita->attributes = $_POST['Cita'];
            if ($modelCita->save()) {
                $this->redirect(['indexCita']);
            }
        }
        $this->render('indexCita', array(
            'listPaciente' => $listPacientes,
            'listAtencionMedica' => $listAtencionMedica,
            'modelCita' => $modelCita,
            'paciente' => $paciente,
            'listCitas' => $listCitas,
        ));
    }

    public function actionUpdate($id)
    {
        $cita = Cita::model()->findByPk($id);
        if (isset($_POST['Cita'])) {
            $cita->attributes = $_POST['Cita'];
            if ($cita->save()) {
                $this->redirect(['indexCita']);
            }
        }
        $this->render('update', ['modelCita' => $cita]);
    }

    public function actionPdfComprobanteCita($id)
    {
        $cita = Cita::model()->findByPk($id);
        $paciente = $cita->paciente;
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('I', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle("Comprobante Cita");
        //cabecera 1 logo santa ana
        $pdf->cabecera1();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario();
        $pdf->cabeceraPaciente($paciente);
        $pdf->titulo('FICHA MEDICA');
        $pdf->comprobante($cita);
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
        Yii::app()->end();

    }
}
