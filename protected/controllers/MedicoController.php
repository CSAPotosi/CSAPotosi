<?php

class MedicoController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        $modelPerson = new PersonaForm();
        $modelEspecialidad = new Especialidad();
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->attributes = $_POST['PersonaForm'];
            //$modelPerson->scenario='paciente';
            if ($modelPerson->saveMedico())
                $this->redirect(array('detalle'));
        }
        $this->render('create', array('modelPerson' => $modelPerson, 'modelEspecialidad' => $modelEspecialidad));
    }
}