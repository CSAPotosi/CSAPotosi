<?php

class ServicioController extends Controller
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
				'actions' => array('Create'),
				'roles' => array('servicioCreate'),
			),
			array('allow',
				'actions' => array('Index'),
				'roles' => array('servicioIndex'),
			),
			array('allow',
				'actions' => array('Update'),
				'roles' => array('servicioUpdate'),
			),
			array('allow',
				'actions' => array('View'),
				'roles' => array('servicioView'),
			),
            array('allow',
                'actions'=>array('salaAddItem'),
                'roles'=>array('servicioSalaAddItem')
            ),
            array('allow',
                'actions'=>array('salaEditItem'),
                'roles'=>array('servicioSalaEditItem')
            ),
            array('allow',
                'actions'=>array('changeStateServicio'),
                'roles'=>array('servicioChangeStateServicio')
            ),
            array('allow',
                'actions'=>array('sala'),
                'roles'=>array('servicioSala')
            ),
            array('allow',
                'actions'=>array('getSalasAjax'),
                'roles'=>array('servicioGetSalasAjax')
            ),
            array('allow',
                'actions'=>array('changeStateSalaAjax'),
                'roles'=>array('servicioChangeStateSalaAjax')
            ),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}
	public function actionIndex($grupo='examen', $tipo = 1)
	{
		switch ($grupo){
			case 'examen':
				$this->examenIndex($tipo);
				break;
			case 'clinico':
				$this->clinicoIndex();
				break;
			case 'sala':
				$this->salaIndex();
				break;
			case 'atencionMedica':
				$this->atencionMedicaIndex($tipo);
				break;
			default:
				echo 'asdassd';
				break;
		}//$this->render('index');
	}

	public function actionCreate($grupo = 'examen', $tipo = 1)
	{
		switch ($grupo) {
			case 'examen':
				$this->examenCreate($tipo);
				break;
			case 'clinico':
				$this->clinicoCreate();
				break;
			case 'sala':
				$this->salaCreate();
				break;
			case 'atencionMedica':
				$this->atencionMedicaCreate($tipo);
				break;
			default:
				throw new CHttpException(404,'Ha ocurrido un problema con la solicitud.');
				break;
		}//$this->render('index');
	}

	public function actionUpdate($grupo = 'examen', $tipo = 1, $id)
	{
		switch ($grupo) {
			case 'examen':
				$this->examenUpdate($tipo, $id);
				break;
			case 'clinico':
				$this->clinicoUpdate($id);
				break;
			case 'sala':
				$this->salaUpdate($id);
				break;
			case 'atencionMedica':
				$this->atencionMedicaUpdate($tipo, $id);
				break;
			default:
				throw new CHttpException(404,'Ha ocurrido un problema con la solicitud.');
				break;
		}
	}

	public function actionView($grupo = 'examen', $tipo = 1, $id = null){
		switch ($grupo) {
			case 'examen':
				echo 'falta';
				break;
			case 'clinico':
				echo 'falta';
				break;
			case 'sala':
				$this->salaView($id);
				break;
			case 'atencionMedica':
				echo 'fa;ta';
				break;
			default:
				echo 'asdassd';
				break;
		}//$this->render('index');
	}

	private function examenIndex($tipo = 1){
		$this->menu = OptionsMenu::menuExamenLab(['tipo' => $tipo], ['examenLab', 'Lista ExamenLab']);
		$listServicio = ServExamen::model()->with('categoria')->findAll(array(
			'condition' => "tipo_ex = :tipo and activo=true",
			'params' => [':tipo' => $tipo]
		));
		$this->render('examenIndex', array('listServicio' => $listServicio, 'dataUrl' => ['grupo' => 'examen', 'tipo' => $tipo]));
	}

	private function clinicoIndex($tipo = 3)
	{
		$this->menu = OptionsMenu::menuExamenLab(['tipo' => $tipo], ['examenLab', 'Lista ExamenLab']);
		$listServicio = ServClinico::model()->findAll();
		$this->render('clinicoIndex', array('listServicio' => $listServicio, 'dataUrl' => array('grupo' => 'clinico')));
	}

	private function salaIndex(){
        $this->menu = OptionsMenu::menuSalas([],['tipoSala','salaList']);
		$tSalaList = ServTipoSala::model()->findAll();
		$this->render('salaIndex', ['tSalaList'=>$tSalaList, 'dataUrl'=>['grupo'=>'sala','tipo'=>0] ]);
	}


////////////////////////////////////////////////
	private function examenCreate($tipo = 1)
	{
		$this->menu = OptionsMenu::menuExamenLab(['tipo' => $tipo], ['examenLab', 'Crear ExamenLab']);
		$examen = new ServicioForm;
		$examen->id_entidad = 1;
		$categoria = CategoriaServExamen::model()->findAll("activo=true and tipo_ex={$tipo}");
		$entidad = Entidad::model()->findAll("id_entidad<>1");
		if (isset($_POST['ServicioForm'])) {
			$examen->setAttributes($_POST['ServicioForm'],false);
			if (!(isset($_POST['ServicioForm']['id_entidad'])))
				$examen->id_entidad = null;
			if ($examen->saveExamen())
				$this->redirect(array('index', 'grupo' => 'examen', 'tipo' => $tipo));
		}
		$this->render('examenCreate', array(
			'servicio' => $examen,
			'categoria' => $categoria,
			'entidad' => $entidad,
			'dataUrl' => array("grupo" => "examen", "tipo" => $tipo),
		));
	}

	private function clinicoCreate($tipo = 3)
	{
		$this->menu = OptionsMenu::menuExamenLab(['tipo' => $tipo], ['examenLab', 'Crear ExamenLab']);
		$clinico = new ServicioForm;
		$clinico->id_entidad = 1;
		$categoria = CategoriaServClinico::model()->findAll("activo=true");
		$entidad = Entidad::model()->findAll("id_entidad<>1");
		if (isset($_POST['ServicioForm'])) {
			$clinico->setAttributes($_POST['ServicioForm'], false);
			if (!(isset($_POST['ServicioForm']['id_entidad'])))
				$clinico->id_entidad = null;
			if ($clinico->saveServicioClinico())
				$this->redirect(array('index', 'grupo' => 'clinico'));
		}
		$this->render('clinicoCreate', array(
			'servicio' => $clinico,
			'categoria' => $categoria,
			'entidad' => $entidad,
			'dataUrl' => array("grupo" => "clinico"),
		));
	}
	public function examenUpdate($tipo = 1, $id)
	{
		$this->menu = OptionsMenu::menuExamenLab(['id_servicio' => $id, 'tipo' => $tipo], ['examenLabs', 'Actualizar']);
		$examen = new ServicioForm();
		$examen->loadData($id);
		if (isset($_POST['ServicioForm'])) {
			$examen->setAttributes($_POST['ServicioForm'], false);
			if ($examen->saveExamen($id))
				$this->redirect(array('index', 'grupo' => 'examen', 'tipo' => $tipo));
		}
		$this->render('examenUpdate', array(
			'servicio' => $examen,
			'dataUrl' => array("grupo" => "examen", "tipo" => $tipo),
		));
	}

	public function clinicoUpdate($id)
	{
		$clinico = new ServicioForm();
		$clinico->loadData($id);
		if (isset($_POST['ServicioForm'])) {
			$clinico->setAttributes($_POST['ServicioForm'], false);
			if ($clinico->saveServicioClinico($id))
				$this->redirect(array('index', 'grupo' => 'clinico'));
		}
		$this->render('clinicoUpdate', array(
			'servicio' => $clinico,
			'dataUrl' => array("grupo" => "clinico"),
		));
	}

	private function atencionMedicaIndex($tipo)
	{
		$this->menu = OptionsMenu::menuAtencionMedica([], ['atenciones', 'Lista ExamenLab']);
		$servicio = new Servicio();
		$listSpecialty = Especialidad::model()->findAll();
		$this->render('atencionMedicaIndex', array('listSpecialty' => $listSpecialty, 'servicio' => $servicio, 'dataUrl' => ['grupo' => 'atencionMedica', 'tipo' => $tipo]));
	}

	private function atencionMedicaCreate($tipo)
	{
		$medicoEspecialidad = MedicoEspecialidad::model()->findByPk($tipo);
		$atencionMedica = new ServicioForm();
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$atencionMedica->setAttributes($_POST['ServicioForm'], false);
			if ($atencionMedica->saveAtencionMedica())
				$this->redirect(['index', 'grupo' => 'atencionMedica']);
		}
		$this->render('atencionMedicaCreate', array(
			'atencionMedica' => $atencionMedica,
			'dataUrl' => ['grupo' => 'atencionMedica'],
			'entidad' => $entidad,
			'MedicoEspecialidad' => $medicoEspecialidad
		));
	}

	private function atencionMedicaUpdate($tipo, $id)
	{
		$this->menu = OptionsMenu::menuAtencionMedica([], ['atenciones', 'indexc']);
		$medicoEspecialidad = MedicoEspecialidad::model()->findByPk($tipo);
		$atencionMedica = new ServicioForm();
		$atencionMedica->loadData($id);
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$atencionMedica->setAttributes($_POST['ServicioForm'], false);
			if ($atencionMedica->saveAtencionMedica($id))
				$this->redirect(['index', 'grupo' => 'atencionMedica', 'tipo' => $tipo]);
		}
		$this->render('atencionMedicaEdit', array(
			'dataUrl' => ['grupo' => 'atencionMedica'],
			'atencionMedica' => $atencionMedica,
			'MedicoEspecialidad' => $medicoEspecialidad,
			'entidad' => $entidad));
	}
	public function loadModel($id)
	{
		$model = Servicio::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/*private function clinicoCreate($tipo = 1)
	{
		echo 'en servicios clinicos';
	}
*/
	private function salaCreate()
	{
        $this->menu = OptionsMenu::menuSalas([],['tipoSala','salaCreate']);

		$tSala = new ServicioForm();
		if(isset($_POST['ServicioForm'])){
			$tSala->setAttributes($_POST['ServicioForm'],false);
			if($tSala->saveTipoSala())
				$this->redirect(['view','grupo'=>'sala', 'id'=>$tSala->id]);
		}
		$this->render('salaCreate', ['tSala' => $tSala, 'dataUrl'=> ['grupo'=>'sala','tipo'=>0] ]);
	}

	private function salaUpdate($id = null){
        $this->menu = OptionsMenu::menuSalas(['ts_id'=>$id],['itemTSala','salaUpdate']);
		$tSala = new ServicioForm();
		$tSala->loadData($id);
		if(isset($_POST['ServicioForm'])){
			$tSala->setAttributes($_POST['ServicioForm'],false);
			if($tSala->saveTipoSala($id))
				$this->redirect(['index','grupo'=>'sala']);
		}
		$this->render('salaUpdate',['tSala'=>$tSala,'dataUrl' => ['grupo'=>'sala']]);
	}

	private function salaView($id = null){
        $this->menu = OptionsMenu::menuSalas(['ts_id'=>$id],['itemTSala','salaView']);

		$tSala = ServTipoSala::model()->findByPk($id);
		$itemSalaModel = new Sala();
		$this->render('salaView',['tSala'=>$tSala,'itemSalaModel'=>$itemSalaModel]);
	}

	public function actionSalaAddItem($id){
		$itemSalaModel = new Sala();
        $itemSalaModel->id_t_sala = $id;
		$this->ajaxValidation($itemSalaModel);
		if(isset($_POST['Sala'])){
			$itemSalaModel->attributes = $_POST['Sala'];
			if($itemSalaModel->save())
				$this->redirect(['view','grupo'=>'sala','id'=>$id]);
		}
		throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
	}

	public function actionSalaEditItem($id){
		$itemSalaModel = Sala::model()->findByPk($id);
		$this->ajaxValidation($itemSalaModel);
		if(isset($_POST['Sala'])){
			$itemSalaModel->attributes = $_POST['Sala'];
			if($itemSalaModel->save())
				$this->redirect(['view','grupo'=>'sala','id'=>$itemSalaModel->id_t_sala]);
		}
		throw  new CHttpException(404,'Ha ocurrido un error en la solicitud.');
	}


	public function actionChangeStateServicio($id)
	{
		$servicio = Servicio::model()->findByPk($id);
		$servicio->activo = !$servicio->activo;
		$servicio->save();
	}

	public function actionSala(){
		return $this->render('sala');
	}

	public function actionGetSalasAjax($type = 0){//0 para seleccionar, 1 para cambiar estados
		$id = 0;
		if(isset($_POST['id']))
			$id = $_POST['id'];

		$salaList = Sala::model()->findAll([
			'condition'=>'id_t_sala = :id AND estado_sala <> 0',
			'params'=>[':id'=>$id],
			'order'=>'cod_sala'
		]);

		return $this->renderPartial('_salaItem',array('salaList'=>$salaList,'type'=> $type));
	}

	public function actionChangeStateSalaAjax($s_id = 0){
		$salaModel = Sala::model()->findByPk($s_id);
		if($salaModel!=null && isset($_POST['state'])){
			$state = $_POST['state'];
			$salaModel->estado_sala = $state;
			$salaModel->save();
		}
	}

	protected function ajaxValidation($model){
		if(isset($_POST['ajax'])){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}