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
}