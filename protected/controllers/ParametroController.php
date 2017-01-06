<?php

class ParametroController extends Controller
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
                'roles' => array('parametroIndex'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('parametroCreate'),
            ),
            array('allow',
                'actions' => array('edit'),
                'roles' => array('parametroEdit'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuEspecialOptions([],['parametros','parametro_Index']);
		$this->render('index');
	}
    public function actionCreate(){
        $this->menu = OptionsMenu::menuEspecialOptions([],['parametros','parametro_Create']);

        $parametro = new Parametro();
        if(isset($_POST['Parametro'])){
            $parametro->attributes = $_POST['Parametro'];
            if($parametro->save()){
                return $this->redirect(['index']);
            }
        }
        $this->render('formParametro',['parametro'=>$parametro]);
    }

    public function actionEdit($id_p = 0){
        $this->menu = OptionsMenu::menuEspecialOptions([],['parametros','parametro_Index']);
        $parametro = Parametro::model()->findByPk($id_p);
        if(isset($_POST['Parametro'])){
            $parametro->attributes = $_POST['Parametro'];
            if($parametro->save()){
                return $this->redirect(['index']);
            }
        }
        $this->render('formParametro',['parametro'=>$parametro]);
    }
}