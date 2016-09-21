<?php

class InternacionController extends Controller{
    private $_historial = null;
    public $menu = [];


	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCreateIngreso(){
        $this->menu = OptionsMenu::menuInternacion();

		$internacionModel = new Internacion('ingreso');
		$internacionModel->motivo_ingreso = 0;$internacionModel->procedencia_ingreso = 0;
		$internacionModel->id_historial = $this->_historial->id_historial;
		if(isset($_POST['Internacion'])){
			$internacionModel->attributes = $_POST['Internacion'];
			if($internacionModel->save()){
                $tempPaciente = $internacionModel->historial->paciente;
                $tempPaciente->estado_paciente = 2;//internado
                $tempPaciente->save();
                $this->addSala($internacionModel->id_inter);
                $this->redirect(['index']);
            }
		}
		$this->render('createIngreso',['internacionModel'=>$internacionModel]);
	}

	public function filters()
	{
		return [
			'historialContext'
		];
	}
/*
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

    private function addSala($inter_id = 0){
        $interModel = Internacion::model()->findByPk($inter_id);
        if($interModel != null && isset($_POST['InternacionSala'])){
            $salaActual = $interModel->salaActual;
            if($salaActual!=null){
                $salaActual->sala->estado_sala = 3;
                $salaActual->sala->save();

                $salaActual->fecha_salida =date('d-m-Y H:i:s');
                $salaActual->save();
            }
            $interSalaModel = new InternacionSala();
            $interSalaModel->attributes = $_POST['InternacionSala'];
            if($interSalaModel->id_sala!=0){
                $interSalaModel->id_inter = $interModel->id_inter;
                if($interSalaModel->save()){
                    $interSalaModel->sala->estado_sala = 2;
                    $interSalaModel->sala->save();
                }
            }
        }
    }


	//probando con filtros
	public function filterHistorialContext($filterChain){
		if(isset($_GET['h_id'])){
			$this->loadHistorial($_GET['h_id']);
		}
		else
			throw new CHttpException(404, 'No ha especificado un historial valido, vuelva a intentarlo');
		$filterChain->run();
	}

	protected function loadHistorial($historialId){
		if($this->_historial == null){
			$this->_historial = HistorialMedico::model()->findByPk($historialId);
			if($this->_historial == null)
				throw new CHttpException(404, 'Ha ocurrido un error en la solicitud.');
		}
		return $this->_historial;
	}


}