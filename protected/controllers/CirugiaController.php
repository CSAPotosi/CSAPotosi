<?php

class CirugiaController extends Controller
{
    //private $_historial = null;

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuCirugia([],['cirugias','index']);

        $listCirugia = Cirugia::model()->findAll();
		$this->render('index',['listCirugia'=>$listCirugia]);
	}

    public function actionGetEventsAjax(){
        header('Content-type: application/json');
        $cList = Cirugia::model()->findAll();
        $cirugias = [];
        foreach ($cList as $cir){
            $item = [
                'id'=>$cir->id_cir,
                'title'=>$cir->historial->paciente->persona->nombres." - ".$cir->sala->tSala->servicio->nombre_serv." (".$cir->sala->cod_sala.")",
                'start'=>$cir->fec_reserva,
                'url'=>CHtml::normalizeUrl(['cirugia/view'])
            ];
            if($cir->reservado){
                $di = new DateInterval('PT'.$cir->tiempo_estimado.'M');
                $end = new DateTime($cir->fec_reserva);
                $end->add($di);
                $item['end'] = $end->format('Y-m-d H:i');
                $item['color'] = '#f00';
            }else{
                ;
            }
            $cirugias[] = $item;
        }
        echo CJSON::encode($cirugias);
        Yii::app()->end();
    }

    public function actionProgramar(){
        $this->menu = OptionsMenu::menuCirugia([],['cirugias','programar']);

        $cirugia = new Cirugia('reserva');
      //  $cirugia->id_historial = $this->_historial->id_historial;
        if(isset($_POST['Cirugia'])){
            $cirugia->attributes = $_POST['Cirugia'];
            if($cirugia->save()){
                return $this->redirect(['index']);
            }
        }
        $this->render('programar',['cirugia'=>$cirugia]);
    }

    public function actionRegistrar(){
        $this->menu = OptionsMenu::menuCirugia([],['cirugias','registrar']);
        $cirugia = new Cirugia();
        $this->render('registrar',['cirugia'=>$cirugia]);
    }

    public function actionView(){
        $this->render('view');
    }

    public function filters()
    {
        return [
            //'historialContext - index,getEventsAjax'
        ];
    }

    public function filterHistorialContext($filterChain){
        if(isset($_GET['h_id']))
            $this->loadHistorial($_GET['h_id']);
        else
            throw new CHttpException(404, 'No ha especificado un historial valido, vuelva a intentarlo');
        $filterChain->run();
    }

    protected function loadHistorial($historialId){
        if($this->_historial == null){
            $this->_historial = HistorialMedico::model()->findByPk($historialId);
            if($this->_historial == null)
                throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
        }
        return $this->_historial;
    }
}