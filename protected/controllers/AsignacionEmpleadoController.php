<?php

class AsignacionEmpleadoController extends Controller
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
                'actions' => array('Index',),
                'roles' => array('asignacionIndex'),
            ),
            array('allow',
                'actions' => array('Create'),
                'roles' => array('asignacionCreate'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('asignacionUpdate'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->menu = OptionsMenu::menuAsignacion([], ['asignaciones', 'Lista Asignacion']);
        $listAsignacion = AsignacionEmpleado::model()->findAll();
        $this->render('index', array('listAsignacion' => $listAsignacion));
    }

    public function actionCreate()
    {
        $this->menu = OptionsMenu::menuAsignacion([], ['asignaciones', 'Crear Asignacion']);
        $modelAsignacionEmpleado = new AsignacionEmpleado();
        if (isset($_POST['AsignacionEmpleado'])) {
            $modelAsignacionEmpleado->attributes = $_POST['AsignacionEmpleado'];
            $modelAsignacionEmpleado->vigente = true;
            if ($modelAsignacionEmpleado->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('modelAsignacionEmpleado' => $modelAsignacionEmpleado));
    }

    public function actionUpdate($id)
    {
        $this->menu = OptionsMenu::menuAsignacion(['id_asignacion' => $id], ['asignacion', 'Actualizar Asignacion']);
        $modelAsignacionEmpleado = AsignacionEmpleado::model()->findByPk($id);
        if (isset($_POST['AsignacionEmpleado'])) {
            $modelAsignacionEmpleado->attributes = $_POST['AsignacionEmpleado'];
            $modelAsignacionEmpleado->vigente = ($_POST['AsignacionEmpleado']['fecha_fin'] != null) ? false : true;
            if ($modelAsignacionEmpleado->vigente == true)
                $modelAsignacionEmpleado->fecha_fin = null;
            if ($modelAsignacionEmpleado->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('update', array('modelAsignacionEmpleado' => $modelAsignacionEmpleado));
    }
}