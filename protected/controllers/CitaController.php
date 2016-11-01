<?php

class CitaController extends Controller
{
    public function actionIndexCita()
    {
        $listPacientes = Paciente::model()->findAll();
        $listAtencionMedica = ServAtencionMedica::model()->findAll();
        $modelCita = new Cita();
        $this->render('indexCita', array(
            'listPaciente' => $listPacientes,
            'listAtencionMedica' => $listAtencionMedica,
            'modelCita' => $modelCita,
        ));
    }
}
