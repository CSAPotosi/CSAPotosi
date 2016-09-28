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
        $this->redirect(array('externoCreate', 'id' => $prestacion->id_historial));
    }
}