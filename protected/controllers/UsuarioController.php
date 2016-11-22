<?php

class UsuarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('view'),
				'roles' => array('usuarioView'),
			),
			array('allow',
				'actions' => array('create'),
				'roles' => array('usuarioCreate'),
			),
			array('allow',
				'actions' => array('update'),
				'roles' => array('usuarioUpdate'),
			),
			array('allow',
				'actions' => array('habilitacionAjax'),
				'roles' => array('usuarioHabilitacionAjax'),
			),
			array('allow',
				'actions' => array('index'),
				'roles' => array('usuarioIndex'),
			),
			array('allow',
				'actions' => array('getUsuarioListAjax'),
				'roles' => array('usuarioGetUsuarioListAjax'),
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
			'roles' => Yii::app()->authManager->getAuthItems(null, $id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Usuario;
		if (isset($_POST['Usuario'])) {
			$model->attributes = $_POST['Usuario'];

			if ($model->validate()) {
				$model->clave = sha1($model->clave);
				$model->claveCompare = sha1($model->claveCompare);
				$trans = Yii::app()->db->beginTransaction();
				try {
					$model->save();
					if (isset($_POST["roles"])) {
						foreach ($_POST["roles"] as $rol) {
							Yii::app()->authManager->assign($rol, $model->id_usuario);
						}
					}
					$trans->commit();
				} catch (Exception $e) {
					echo "Excepcion: " . $e->getMessage() . "/n";
					$trans->rollback();
					//todo-le: Agregar pagina de excepcion
					Yii::app()->end();
				}
				$this->redirect(array('view', 'id' => $model->id_usuario));
			}
		}
		$personas = CHtml::listData(Persona::model()->findAll(array('order' => 'primer_apellido')), 'id_persona', function ($p) {
			return $p->primer_apellido . " " . $p->segundo_apellido . " " . $p->nombres;
		});
		$roles = Yii::app()->authManager->getRoles();
		$rolesAsignados = array();
		$this->render('create', array(
			'model' => $model,
			'personas' => $personas,
			'roles' => $roles,
			'rolesAsignados' => $rolesAsignados,
		));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if (isset($_POST['Usuario'])) {
			$aux = $model->clave;
			$model->attributes = $_POST['Usuario'];
			if ($model->validate()) {
				if ($aux != $model->clave) {
					$model->clave = sha1($model->clave);
					$model->claveCompare = sha1($model->claveCompare);
				}
				$trans = Yii::app()->db->beginTransaction();
				try {
					$model->save();
					$query = "delete from \"AuthAssignment\" where userid= '" . $model->id_usuario . "';";
					$command = Yii::app()->db->createCommand($query);
					$command->execute();
					if (isset($_POST["roles"])) {
						foreach ($_POST["roles"] as $rol) {
							Yii::app()->authManager->assign($rol, $model->id_usuario);
						}
					}
					$trans->commit();
				} catch (Exception $e) {
					echo "Excepcion: " . $e->getMessage() . "/n";
					$trans->rollback();
					//todo-le: Agregar pagina de excepcion
					Yii::app()->end();
				}
				$this->redirect(array('view', 'id' => $model->id_usuario));
			}
		}
		$model->claveCompare = $model->clave;
		$personas = CHtml::listData(Persona::model()->findAll(array('order' => 'primer_apellido')), 'id_persona', function ($p) {
			return $p->primer_apellido . " " . $p->segundo_apellido . " " . $p->nombres;
		});
		$roles = Yii::app()->authManager->getRoles();
		$rolesAsignados = Yii::app()->authManager->getAuthItems(null, $model->id_usuario);
		$this->render('update', array(
			'model' => $model,
			'personas' => $personas,
			'roles' => $roles,
			'rolesAsignados' => $rolesAsignados,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionHabilitacionAjax($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Usuario::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
