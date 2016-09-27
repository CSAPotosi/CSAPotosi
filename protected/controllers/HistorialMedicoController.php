<?php

class HistorialMedicoController extends Controller
{
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