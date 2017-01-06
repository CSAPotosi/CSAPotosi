<?php

class CieController extends Controller
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
                'roles' => array('cieIndex'),
            ),
            array('allow',
                'actions' => array('getCategoryAjax'),
                'roles' => array('cieGetCategoryAjax'),
            ),
            array('allow',
                'actions' => array('getGroupAjax'),
                'roles' => array('cieGetGroupAjax'),
            ),
            array('allow',
                'actions' => array('getItemAjax'),
                'roles' => array('cieGetItemAjax'),
            ),
            array('allow',
                'actions' => array('getDetailItemAjax'),
                'roles' => array('cieGetDetailItemAjax'),
            ),
            array('allow',
                'actions' => array('editDescripcion'),
                'roles' => array('cieEditDescripcion'),
            ),
            array('allow',
                'actions' => array('getCieAjax'),
                'roles' => array('cieGetCieAjax'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuEspecialOptions([],['cie','cie_Index']);
		$this->render('index');
	}

	public function actionGetCategoryAjax(){
		$code = $_POST['code'];

		$categoryList = CategoriaCie::model()->findAll([
			'condition'=>'num_cap = :num_cap',
			'params'=>[':num_cap'=>$code]
		]);
		$data = CHtml::listData( $categoryList, 'id_cat', 'titulo_cat' );
		foreach ($data as $value => $text)
			echo CHtml::tag('option',['value'=>$value],CHtml::encode($text),true);
	}

	public function actionGetGroupAjax(){
		$code = $_POST['code'];

		$groupList = ItemCie::model()->findAll([
			'condition'=>'id_cat = :id_cat AND codigo = codigo_padre',
			'params'=>[':id_cat'=>$code]
		]);
		$data = CHtml::listData( $groupList, 'codigo', 'titulo' );
		foreach ($data as $value => $text)
			echo CHtml::tag('option',['value'=>$value],CHtml::encode($text),true);
	}

	public function actionGetItemAjax(){
		$code = $_POST['code'];
		$query = $_POST['query'];
        $detail = false;
        if(isset($_POST['detail'])&& $_POST['detail']=='true')
            $detail = $_POST['detail'];
		$condition = "";

		if($code!="")
			$condition = 'codigo_padre = :code AND';
		elseif ($query == "")
			return $this->renderPartial('_itemCieList',['itemList'=>[]]);

		$itemList = ItemCie::model()->findAll([
			'condition'=>"{$condition} (codigo like :cadena OR titulo like :cadena OR descripcion like :cadena)",
			'params'=>[':code'=>$code,':cadena'=>'%'.$query.'%']
		]);

		$this->renderPartial('_itemCieList',['itemList'=>$itemList,'detail'=>$detail]);
	}

	public function actionGetDetailItemAjax(){
		$code = $_POST['code'];

		$cieModel = ItemCie::model()->findByPk($code);
		$this->renderPartial('_detailItemCie',['cieModel'=>$cieModel]);
	}

	public function actionEditDescripcion(){
		$code = $_POST['pk'];
		$descr = $_POST['value'];

		$cieModel = ItemCie::model()->findByPk($code);
		$cieModel->descripcion=$descr;
		if($cieModel->save())
			print_r($_POST);
		else{
			header('HTTP/1.0 400 Bad Request', true, 400);
			echo "Error de guardado!";
		}
	}

    public function actionGetCieAjax(){
        $this->renderPartial('_cie');
    }

}