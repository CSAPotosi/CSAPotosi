<?php

class SetupController extends Controller
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
                'roles' => array('setupIndex'),
            ),
            array('allow',
                'actions' => array('edit'),
                'roles' => array('setupEdit'),
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

    public function actionEdit($id){
        $setup = Setup::model()->findByPk($id);
        if($setup){
            if(isset($_POST['Setup'])){
                $setup->attributes = $_POST['Setup'];
                if($setup->save())
                    return $this->redirect(['setup/index']);
            }
            return $this->render('edit',['setup'=>$setup]);
        }
        $this->redirect(['setup/index']);
    }

}