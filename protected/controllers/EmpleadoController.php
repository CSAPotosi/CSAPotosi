<?php

class EmpleadoController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionEmployeeCreate()
    {
        $modelPerson = new PersonaForm();
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->attributes = $_POST['PersonaForm'];
            //$modelPerson->scenario='paciente';
            $modelPerson->saveEmpleado();

        }
        $this->render('employeeCreate', array('modelPerson' => $modelPerson));
    }
}