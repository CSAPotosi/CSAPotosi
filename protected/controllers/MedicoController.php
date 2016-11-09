<?php

class MedicoController extends Controller
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
                'actions' => array('create', 'CreateSpecialyAjax', 'onlyMedico', 'index', 'GetMedicoListAjax'),
                'roles' => array('createMedico'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        $modelPerson = new PersonaForm();
        $modelEspecialidad = new Especialidad();
        $listEspecialidad = Especialidad::model()->findAll();
        $modelMedicoEspe = new MedicoEspecialidad();
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->setAttributes($_POST['PersonaForm'], false);
            $id_medico = $modelPerson->saveMedico();
            if ($id_medico != 0) {
                if (isset($_POST['MedicoEspecialidad'])) {
                    foreach ($_POST['MedicoEspecialidad'] as $model) {
                        $modelME = new MedicoEspecialidad();
                        $modelME->attributes = $model;
                        $modelME->id_medico = $id_medico;
                        $modelME->save();
                    }
                }
                $this->redirect(['index']);
            }
        }
        $this->render('create', array(
            'modelPerson' => $modelPerson, 'modelEspecialidad' => $modelEspecialidad,
            'listSpecialty' => $listEspecialidad, 'modelMedicoEspe' => $modelMedicoEspe,
        ));
    }

    public function actionCreateSpecialyAjax()
    {
        $modelEspecialidad = new Especialidad();
        $modelMedicoEspe = new MedicoEspecialidad();
        if (isset($_POST['Especialidad'])) {
            $modelEspecialidad->attributes = $_POST['Especialidad'];
            if ($modelEspecialidad->save()) {
                $listSpecialty = Especialidad::model()->findAll(array(
                    'order' => 'id_especialidad ASC',
                ));
                $this->renderPartial('_specialtyList', array('listSpecialty' => $listSpecialty, 'modelMedicoEspe' => $modelMedicoEspe));
                return;
            }
        }
        $this->renderPartial('_formSpecialty', array('modelEspecialidad' => $modelEspecialidad));
    }

    public function actiononlyMedico($id)
    {
        $modelMedico = new Medico();
        $modelEmpleado = Empleado::model()->findByPk($id);
        $modelMedicoEspe = new MedicoEspecialidad();
        $listEspecialty = Especialidad::model()->findAll();
        $modelEspecialidad = new Especialidad();
        if (isset($_POST['Medico'])) {
            $modelMedico->attributes = $_POST['Medico'];
            if ($modelMedico->save()) {
                if (isset($_POST['MedicoEspecialidad'])) {
                    foreach ($_POST['MedicoEspecialidad'] as $model) {
                        $modelME = new MedicoEspecialidad();
                        $modelME->attributes = $model;
                        $modelME->id_medico = $modelMedico->id_medico;
                        $modelME->save();
                    }
                }
                $this->redirect(['index']);
            }
        }
        $this->render('onlyMedico', array(
            'modelMedico' => $modelMedico, 'id' => $modelEmpleado->id_empleado,
            'listSpecialty' => $listEspecialty, 'modelEspecialidad' => $modelEspecialidad,
            'modelMedicoEspe' => $modelMedicoEspe,
        ));
    }

    public function actionGetMedicoListAjax()
    {
        $page = $_POST['page'] * Yii::app()->params['itemListLimit'];
        $query = $_POST['query'];
        $medicoList = Medico::getMedicoList($page, $query);
        $this->renderPartial('_medicoListView', ['medicoList' => $medicoList]);
    }
}