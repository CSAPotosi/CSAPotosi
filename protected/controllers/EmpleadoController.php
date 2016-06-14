<?php

class EmpleadoController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        $modelPerson = new PersonaForm();
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->attributes = $_POST['PersonaForm'];
            //$modelPerson->scenario='paciente';
            $modelPerson->saveEmpleado();

        }
        $this->render('create', array('modelPerson' => $modelPerson));
    }
}