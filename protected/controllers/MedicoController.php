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
                'actions' => array('create', 'CreateSpecialyAjax'),
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
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->attributes = $_POST['PersonaForm'];
            //$modelPerson->scenario='paciente';
            if ($modelPerson->saveMedico())
                $this->redirect(array('detalle'));
        }
        $this->render('create', array('modelPerson' => $modelPerson, 'modelEspecialidad' => $modelEspecialidad, 'listSpecialty' => $listEspecialidad));
    }

    public function actionCreateSpecialyAjax()
    {
        $modelEspecialidad = new Especialidad();
        if (isset($_POST['Especialidad'])) {
            $modelEspecialidad->attributes = $_POST['Especialidad'];
            if ($modelEspecialidad->save()) {
                $listSpecialty = Especialidad::model()->findAll(array(
                    'order' => 'id_especialidad ASC',
                ));
                $this->renderPartial('_specialtyList', array('listSpecialty' => $listSpecialty));
                return;
            }
        }
        $this->renderPartial('_formSpecialty', array('modelEspecialidad' => $modelEspecialidad));
    }
}