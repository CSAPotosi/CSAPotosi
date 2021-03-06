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
            array('allow',
                'actions' => array('BuscarHora'),
                'roles' => array('citaBuscarHora'),
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

    public function actionBuscarHora()
    {
        $especialidad = $_POST['atencion'];
        $fecha = $_POST['fecha'];
        $paciente = $_POST['paciente'];
        $listaCitas = Cita::model()->findAll(['condition' => "fecha='$fecha' and id_paciente=$paciente and medico_consulta_servicio=$especialidad"]);
        $listahoraOcupada = array();
        foreach ($listaCitas as $item) {
            $listahoraOcupada[] = date('H:i', strtotime($item->hora_cita));
        }
        $vectorResult = array_diff($this->Horas(), $listahoraOcupada);
        foreach ($vectorResult as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $descripcion), CHtml::encode($descripcion), true);
        }
    }

    private function Horas()
    {
        $hora_inicio = '00:00';
        $listahora = array();
        $i = 0;
        while ($i <= 95) {
            $listahora[] = $hora_inicio;
            $hora_inicio = date('H:i', strtotime($hora_inicio . '+15 minutes'));
            $i++;
        }
        return $listahora;
    }
}
