<?php

class UnidadController extends Controller
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
                'actions' => array('index'),
                'roles' => array('indexUnidad'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('createUnidad'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('updateUnidad'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $listUnidad = Unidad::model()->findAll();
        $this->render('index', array('listUnidad' => $listUnidad));
    }

    public function actionCreate()
    {
        $modelUnidad = new Unidad();
        if (isset($_POST['Unidad'])) {
            $modelUnidad->attributes = $_POST['Unidad'];
            if ($modelUnidad->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render("create", array('modelUnidad' => $modelUnidad));
    }

    public function actionUpdate($id)
    {
        $modelUnidad = Unidad::model()->findByPk($id);
        if (isset($_POST['Unidad'])) {
            $modelUnidad->attributes = $_POST['Unidad'];
            if ($modelUnidad->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render("update", array('modelUnidad' => $modelUnidad));
    }
}