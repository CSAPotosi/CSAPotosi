<?php

class DiagnosticoController extends Controller
{
    private $_historial = null;

	public function actionCreate(){
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial], ['historial','newDiagnostico']);

        $this->render('create');
    }


    public function filters()
    {
        return [
            'historialContext'
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

    protected function loadHistorial($historialId){
        if($this->_historial == null){
            $this->_historial = HistorialMedico::model()->findByPk($historialId);
            if($this->_historial == null)
                throw new CHttpException(404, 'Ha ocurrido un error en la solicitud.');
        }
        return $this->_historial;
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