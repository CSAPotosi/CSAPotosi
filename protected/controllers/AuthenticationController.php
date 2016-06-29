<?php

class AuthenticationController extends Controller
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('init'),
                'users' => array('*'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'roles' => array('authenticationIndex'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $roleList = Yii::app()->authManager->getRoles();
        $taskList = Yii::app()->authManager->getOperations();
        $this->render('index', array('roleList' => $roleList, 'taskList' => $taskList));
    }

    public function actionInit()
    {
        //var_dump(Yii::app()->user->name);
        //Yii::app()->end();
        if (isset($_POST['reset'])) {
            $this->initDefaultAdmin();
            $this->redirect(array('init'));
        }
        if (isset($_POST['adminuser'])) {
            $this->resetRoles($_POST['adminuser']);
            $this->redirect(array('index'));
        }
        $this->render('init');
    }

    public function initDefaultAdmin()
    {
        $persona = new Persona;
        $persona->num_doc = "123456";
        $persona->nombres = "admin";
        $persona->primer_apellido = "admin";
        $persona->save();
        $usuario = new Usuario;
        $usuario->id_usuario = $persona->id_persona;
        $usuario->nombre_usuario = "admin";
        $usuario->clave = sha1("admin");
        $usuario->save();
    }

    public function resetRoles($user)
    {
        $auth = Yii::app()->authManager;
        $auth->clearAll();
        $this->addOperations();
        $auth->createRole('admin', 'Rol de Administrador', 'return Yii::app()->user->name === "' . $user . '";');
        $todos = Yii::app()->authManager->getOperations();
        foreach ($todos as $item) {
            $auth->addItemChild("admin", $item->name);
        }
        $auth->assign('admin', $user);
    }

    public function addOperations()
    {
        $auth = Yii::app()->authManager;
        $auth->createOperation('usuarioIndex', "index de usuario");
        $auth->createOperation('usuarioCreate', "Crear un nuevo usuario");
        $auth->createOperation('authenticationIndex', "Mostrar los Roles");


    }
    //public function action

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