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
}