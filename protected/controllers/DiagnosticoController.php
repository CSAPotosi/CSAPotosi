<?php

class DiagnosticoController extends Controller
{
    private $_historial = null;
    private $_diagnostico = null;

	public function actionCreate(){
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial], ['historial','newDiagnostico']);
        $dcList = [];
        $diagnosticoModel = new Diagnostico();
        $diagnosticoModel->id_historial = $this->_historial->id_historial;
        if($this->_historial->internacionActual){
            $diagnosticoModel->tipo = 1;
        }
        if(isset($_POST['Diagnostico'])){
            $dcList = $this->getItemsCie();
            $diagnosticoModel->attributes = $_POST['Diagnostico'];
            if($diagnosticoModel->save()){
                foreach ($dcList as $dcItem){
                    $dcItem->id_diag = $diagnosticoModel->id_diag;
                    $dcItem->save();
                }
            }
        }
        $this->render('create',['diagnosticoModel'=>$diagnosticoModel, 'historialModel'=>$this->_historial,'dcList'=>$dcList]);
    }

    public function actionView(){
        $this->menu = OptionsMenu::menuDiagnostico([],['','']);
        $this->render('view',['dModel'=>$this->_diagnostico]);
    }


    public function filters()
    {
        return [
            'historialContext + create',
            'diagnosticoContext - create'
        ];
    }

    public function filterHistorialContext($filterChain){
        if(isset($_GET['h_id'])){
            $this->loadHistorial($_GET['h_id']);
        }
        else
            throw new CHttpException(404, 'No ha especificado un historial valido, vuelva a intentarlo');
        $filterChain->run();
    }

    public function filterDiagnosticoContext($filterChain){
        if(isset($_GET['d_id']))
            $this->loadDiagnostico($_GET['d_id']);
        else
            throw new CHttpException(404,'No ha especificado un diagnostico valido, vuelva a intentarlo');
        $filterChain->run();
    }

    protected function loadDiagnostico($d_id){
        if($this->_diagnostico == null){
            $this->_diagnostico = Diagnostico::model()->findByPk($d_id);
            if($this->_diagnostico == null)
                throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
        }
        return $this->_diagnostico;
    }

    protected function loadHistorial($historialId){
        if($this->_historial == null){
            $this->_historial = HistorialMedico::model()->findByPk($historialId);
            if($this->_historial == null)
                throw new CHttpException(404, 'Ha ocurrido un error en la solicitud.');
        }
        return $this->_historial;
    }

    private function getItemsCie(){
        $items = [];
        if(isset($_POST['DiagnosticoCie'])){
            foreach ($_POST['DiagnosticoCie'] as $dcItem){
                $dcModel = new DiagnosticoCie();
                $dcModel->attributes = $dcItem;
                $items[]=$dcModel;
            }
        }
        return $items;
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