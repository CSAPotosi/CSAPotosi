<?php

class SetupController extends Controller
{
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