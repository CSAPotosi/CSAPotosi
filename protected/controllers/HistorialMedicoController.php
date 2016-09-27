<?php

class HistorialMedicoController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionExternoCreate($id)
    {
        $Paciente = Paciente::model()->findByPk($id);
        $this->render('externoCreate', array(
            'Paciente' => $Paciente,
        ));
    }

    public function actionPrestacionCreate()
    {
        $modelPrestacion = new PrestacionServicios();
        $modelPrestacion->id_historial = $_POST['PrestacionServicios']['id_historial'];
        $modelPrestacion->observaciones = $_POST['PrestacionServicios']['observaciones'];
        $modelPrestacion->tipo = $_POST['PrestacionServicios']['tipo'];
        $modelPrestacion->fecha_solicitud = date('Y-d-m');
        $modelPrestacion->save();
        header('Content-Type:application/json;');
        echo CJSON::encode(array('success' => true, 'jsonPrestacion' => $modelPrestacion->id_prestacion));
    }
}