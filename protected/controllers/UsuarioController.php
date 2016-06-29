<?php

class UsuarioController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index'),
                'roles' => array('usuarioIndex'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'GetUsuarioListAjax'),
                'roles' => array('usuarioCreate'),
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

    public function actionGetUsuarioListAjax()
    {
        $page = $_POST['page'] * Yii::app()->params["itemListLimit"];
        $query = $_POST['query'];
        $status = $_POST['status'];
        $usuarioList = Usuario::getUsuarioList($page, $query, $status);
        $this->renderPartial('_usuarioListView', ['usuarioList' => $usuarioList]);
    }

    public function actionCreate()
    {
        $usuario = new Usuario;
        $personaList = Persona::model()->findAll();
        if (isset($_POST['Usuario'])) {
            $usuario->attributes = $_POST['Usuario'];
            $usuario->clave = sha1($usuario->clave);
            if ($usuario->save())
                $this->redirect(array('view', 'id' => $usuario->id_usuario));
        }
        $this->render('create', array(
            'usuario' => $usuario,
            'personaList' => $personaList,
        ));
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}