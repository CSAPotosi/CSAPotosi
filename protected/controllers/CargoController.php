<?php

class CargoController extends Controller
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
                'actions' => array('index', 'ChangeStateCargo'),
                'roles' => array('indexCargo'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('createCargo'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex($id)
    {
        $listCargo = Cargo::model()->findAll(array(
            'condition' => "id_unidad ='{$id}'",
        ));
        $modelUnidad = Unidad::model()->findByPk($id);
        $this->render("index", array('listCargo' => $listCargo, 'id' => $id, 'modelUnidad' => $modelUnidad));
    }

    public function actioncreate($id)
    {
        $modelCargo = new Cargo();
        $modelUnidad = Unidad::model()->findByPk($id);
        if (isset($_POST['Cargo'])) {
            $modelCargo->attributes = $_POST['Cargo'];
            if ($modelCargo->save()) {
                $this->redirect(array('index', 'id' => $modelCargo->id_unidad));
            }
        }
        $this->render('create', array('modelCargo' => $modelCargo, 'id' => $id, 'modelUnidad' => $modelUnidad));
    }

    public function actionChangeStateCargo($id)
    {
        $cargo = Cargo::model()->findByPk($id);
        $cargo->estado = !$cargo->estado;
        $cargo->save();
    }
}