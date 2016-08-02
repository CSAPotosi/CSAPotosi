<?php

class TurnoController extends Controller
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
                'actions' => array('create'),
                'roles' => array('createTurno'),
            ),
            array('allow',
                'actions' => array('index'),
                'roles' => array('indexTurno'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('updateTurno'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionindex()
    {
        $listTurno = Turno::model()->findAll();
        $this->render('index', array('listTurno' => $listTurno));
    }

    public function actionCreate()
    {
        $modelTurno = new Turno();
        if (isset($_POST['Turno'])) {
            $modelTurno->attributes = $_POST['Turno'];
            if ($modelTurno->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('modelTurno' => $modelTurno));
    }

    public function actionUpdate($id)
    {
        $modelTurno = Turno::model()->findByPk($id);
        if (isset($_POST['Turno'])) {
            $modelTurno->attributes = $_POST['Turno'];
            if ($modelTurno->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('modelTurno' => $modelTurno));
    }
}