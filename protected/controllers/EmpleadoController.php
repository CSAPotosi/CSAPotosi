<?php

class EmpleadoController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('Index'),
                'roles' => array('empleadoIndex'),
            ),
            array('allow',
                'actions' => array('Create'),
                'roles' => array('empleadoCreate'),
            ),
            array('allow',
                'actions' => array('GetEmpleadoListAjax'),
                'roles' => array('empleadoGetEmpleadoListAjax'),
            ),
            array('allow',
                'actions' => array('DetalleEmpleado'),
                'roles' => array('empleadoDetalleEmpleado'),
            ),
            array('allow',
                'actions' => array('Update'),
                'roles' => array('empleadoUpdate'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    public function actionIndex()
    {
        $this->menu = OptionsMenu::menuEmpleado([], ['empleados', 'index']);
        $this->render('index');
    }

    public function actionCreate()
    {
        $this->menu = OptionsMenu::menuempleado([], ['empleados', 'create']);
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
        $this->menu = OptionsMenu::menuempleado(['id_empleado' => $id], ['empleado', 'detalleEmpleado']);
        $empleado = Empleado::model()->findByPk($id);
        $this->render('detalleEmpleado', ['empleado' => $empleado]);
    }

    public function actionUpdate($id)
    {
        $this->menu = OptionsMenu::menuEmpleado(['id_empleado' => $id], ['empleado', 'updateEmpleado']);
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