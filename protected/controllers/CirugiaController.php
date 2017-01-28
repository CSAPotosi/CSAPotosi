<?php

class CirugiaController extends Controller
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
                'roles' => array('cirugiaIndex'),
            ),
            array('allow',
                'actions' => array('getEventsAjax'),
                'roles' => array('cirugiaGetEventsAjax'),
            ),
            array('allow',
                'actions' => array('programar'),
                'roles' => array('cirugiaProgramar'),
            ),
            array('allow',
                'actions' => array('registrar'),
                'roles' => array('cirugiaRegistrar'),
            ),
            array('allow',
                'actions' => array('view'),
                'roles' => array('cirugiaView'),
            ),
            array('allow',
                'actions' => array('cancelar'),
                'roles' => array('cirugiaCancelar'),
            ),
            array('allow',
                'actions' => array('getMinimalList'),
                'roles' => array('cirugiaGetMinimalList'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuCirugia([],['cirugias','cirugia_Index']);

        $listCirugia = Cirugia::model()->findAll();
		$this->render('index',['listCirugia'=>$listCirugia]);
	}

    public function actionGetEventsAjax(){
        header('Content-type: application/json');
        $cList = Cirugia::model()->findAll([
            'condition'=> "fec_reserva::DATE between :fec_ini and :fec_fin or fec_inicio::DATE between :fec_ini and :fec_fin",
            'params'=> [ ':fec_ini'=>$_POST['firstDate'], ':fec_fin'=>$_POST['lastDate'] ]
        ]);
        $cirugias = [];
        foreach ($cList as $cir){
            $item = [
                'id'=>$cir->id_cir,
                'title'=>$cir->historial->paciente->persona->nombreCompleto." - ".$cir->sala->tSala->servicio->nombre_serv." (".$cir->sala->cod_sala.")",
                'start'=>$cir->fec_reserva,
                'url'=>CHtml::normalizeUrl(['cirugia/view','c_id'=>$cir->id_cir])
            ];
            if($cir->reservado){
                $di = new DateInterval('PT'.$cir->tiempo_estimado.'M');
                $end = new DateTime($cir->fec_reserva);
                $end->add($di);
                $item['title']= 'R: '.$item['title'];
                $item['end'] = $end->format('Y-m-d H:i');
                $item['color'] = '#6311C0';
            }else{
                $item['color'] = '#11A6C0';
                $item['start'] = $cir->fec_inicio;
                $item['end'] = $cir->fec_fin;
            }
            $cirugias[] = $item;
        }
        echo CJSON::encode($cirugias);
        Yii::app()->end();
    }

    public function actionProgramar($c_id = 0){
        $this->menu = OptionsMenu::menuCirugia(['c_id'=>$c_id],['cirugias','cirugia_Programar']);

        $cirugia = new Cirugia('reserva');
        if($c_id){
            $cirugia = Cirugia::model()->findByPk($c_id);
            $cirugia->scenario = 'reserva';
            $this->menu = OptionsMenu::menuCirugia(['c_id'=>$c_id],['itemCirugia','cirugia_Programar']);
        }
        $cirugia->reservado = true;
        if(isset($_POST['Cirugia'])){
            $cirugia->attributes = $_POST['Cirugia'];
            if($cirugia->save()){
                return $this->redirect(['view','c_id'=>$cirugia->id_cir]);
            }
        }
        $this->render('programar',['cirugia'=>$cirugia]);
    }

    public function actionRegistrar($c_id = 0){
        $this->menu = OptionsMenu::menuCirugia([],['cirugias','cirugia_Registrar']);
        $cirugia = new Cirugia('registro');
        $persList = $this->loadPersonal($c_id);
        if($c_id){
            $this->menu = OptionsMenu::menuCirugia(['c_id'=>$c_id],['itemCirugia','cirugia_Registrar']);
            $cirugia = Cirugia::model()->findByPk($c_id);
            $cirugia->scenario = 'registro';
        }
        $cirugia->reservado = false;
        if (isset($_POST['Cirugia'],$_POST['PersonalCirugia'])){
            $cirugia->attributes = $_POST['Cirugia'];
            if($this->validar(array_merge([$cirugia],$persList))){
                $cirugia->save();
                foreach ($cirugia->personalCirugias as $per)
                    $per->delete();
                foreach ($persList as $per){
                    $per->id_cir = $cirugia->id_cir;
                    $per->save();
                }
                return $this->redirect(['view','c_id'=>$cirugia->id_cir]);
            }
        }
        $this->render('registrar',['cirugia'=>$cirugia,'persList'=>$persList]);
    }

    public function actionView($c_id = 0){
        $this->menu = OptionsMenu::menuCirugia(['c_id'=>$c_id],['itemCirugia','cirugia_Ver']);
        $cirugia = Cirugia::model()->findByPk($c_id);
        $this->render('view',['cirugia'=>$cirugia]);
    }

    public function actionCancelar($c_id = 0){
        $this->menu = OptionsMenu::menuCirugia(['c_id'=>$c_id],['itemCirugia','cirugia_Cancelar']);
        $cirugia = Cirugia::model()->findByPk($c_id);
        if(isset($_POST['Cirugia'])){
            $cirugia->delete();
            return $this->redirect(['index']);
        }
        return $this->render('cancelar',['cirugia'=>$cirugia]);
    }

    public function actionGetMinimalList(){
        $medicoList = Medico::model()->findAll(['limit'=>5]);
        $enfList = Empleado::model()->findAll(['limit'=>5]);
        $this->renderPartial('_minimalPersonList',['medicoList'=>$medicoList, 'enfList'=>$enfList]);
    }

    private function loadPersonal($id_cir=0){
        $persList = [];
        if(isset($_POST['PersonalCirugia'])){
            foreach ($_POST['PersonalCirugia'] as $item){
                $temp = new PersonalCirugia();
                $temp->attributes = $item;
                $persList[] = $temp;
            }
        }
        else{
            $cir = Cirugia::model()->findByPk($id_cir);
            if($cir && $cir->personalCirugias){
                $persList = $cir->personalCirugias;
            }
            else{
                $pc = new PersonalCirugia();$pc->responsable=true;
                $persList[]= $pc;
            }

        }

        return $persList;
    }

    private function validar($lista = []){
        $flag = true;
        foreach ($lista as $item)
            $flag = $flag && $item->validate();
        return $flag;
    }
}