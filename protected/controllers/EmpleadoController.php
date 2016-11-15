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
            $modelPerson->setAttributes($_POST['PersonaForm'], false);
            $id_empleado = $modelPerson->saveEmpleado();
            if ($id_empleado != 0)
                if ($_POST['medico']) {
                    $this->redirect(["medico/onlyMedico", 'id' => $id_empleado]);
                } else {
                    $this->redirect(["empleado/index"]);
                }

        }
        $this->render('create', array('modelPerson' => $modelPerson));
    }

    public function actionGetEmpleadoListAjax()
    {
        $page = $_POST['page'] * Yii::app()->params['itemListLimit'];
        $query = $_POST['query'];
        $empleadoList = Empleado::getEmpleadoList($page, $query);
        $this->renderPartial('_empleadoListView', ['empleadoList' => $empleadoList]);
    }

    public function actionDetalleEmpleado($id)
    {
        $empleado = Empleado::model()->findByPk($id);
        $this->render('detalleEmpleado', ['empleado' => $empleado]);
    }

    public function actionUpdate($id)
    {
        $modelPerson = new PersonaForm();
        $persona = Persona::model()->findByPk($id);
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->setAttributes($_POST['PersonaForm'], false);
            $id_empleado = $modelPerson->saveEmpleado($id);
            if ($id_empleado != 0) {
                if ($_POST['medico'] == 1)
                    $this->redirect(["medico/onlyMedico", 'id' => $id_empleado]);
                if ($_POST['medico'] == 0)
                    $this->redirect(["empleado/DetalleEmpleado", 'id' => $id_empleado]);
            }

        }
        $this->render('update', array('modelPerson' => $modelPerson, 'persona' => $persona));
    }
}