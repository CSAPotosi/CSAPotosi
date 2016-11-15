<?php

class ExamenController extends Controller
{
	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuExamen([],['examen','index']);

        $examenList = DetallePrestacion::model()->findAll([
            'condition' => 'NOT realizado',
            'order'=>'fecha_solicitud DESC'
        ]);
		$this->render('index',['examenList'=>$examenList]);
	}

    public function actionList(){
        $this->menu = OptionsMenu::menuExamen([],['examen','list']);

        $examenList = DetallePrestacion::model()->findAll([
            'condition' => 'realizado',
            'order'=>'fecha_solicitud DESC'
        ]);
        $this->render('list',['examenList'=>$examenList]);
    }

    public function actionExamen(){
        $this->menu = OptionsMenu::menuExamen([],['examen','examen']);

        $examenList = ServExamen::model()->with([
            'categoria'=>['condition'=>'tipo_ex = 1']
        ])->findAll();
        $this->render('examen',['examenList'=>$examenList]);
    }

    public function actionAdminExamenParams($id_ex=0){
        $this->menu = OptionsMenu::menuExamen([],['examen','examen']);

        $examen = ServExamen::model()->findByPk($id_ex);
        $epList = $examen->examenParametros;
        if(isset($_POST['ServExamen'])){
            $epList = $this->loadData();
            if($this->validar($epList)){
                foreach ($examen->examenParametros as $param)
                    $param->delete();
                foreach ($epList as $epItem){
                    $epItem->id_serv = $examen->id_serv;
                    $epItem->save();
                }
                return $this->redirect(['adminExamenParams','id_ex'=>$examen->id_serv]);
            }
        }

        $this->render('adminExamenParams',['examen'=>$examen,'epList'=>$epList]);
    }

    public function actionParametros(){
        $this->menu = OptionsMenu::menuExamen([],['examen','parametros']);
        $this->render('parametros');
    }

    public function actionCreateParametro(){
        $this->menu = OptionsMenu::menuExamen([],['examen','parametros']);

        $parametro = new Parametro();
        if(isset($_POST['Parametro'])){
            $parametro->attributes = $_POST['Parametro'];
            if($parametro->save()){
                return $this->redirect(['parametros']);
            }
        }
        $this->render('formParametro',['parametro'=>$parametro]);
    }

    public function actionEditParametro($id_p = 0){
        $this->menu = OptionsMenu::menuExamen([],['examen','parametros']);

        $parametro = Parametro::model()->findByPk($id_p);
        if(isset($_POST['Parametro'])){
            $parametro->attributes = $_POST['Parametro'];
            if($parametro->save()){
                return $this->redirect(['parametros']);
            }
        }
        $this->render('formParametro',['parametro'=>$parametro]);
    }

    public function actionGetParamsTable(){
        $paramsList = Parametro::model()->findAll(['condition'=>'tipo_par = 0']);
        $this->renderPartial('_paramsTable',['paramsList'=>$paramsList]);
    }

    public function actionCreateResultadoExamen($id_det_pres = 0){
        $this->menu = OptionsMenu::menuExamen([],['examen','index']);

        $detallePrestacion = DetallePrestacion::model()->findByPk($id_det_pres);
        $resultado = new ResultadoExamen();
        $resultado->id_det_pres = $id_det_pres;
        $detalleList = $this->loadForm($detallePrestacion->id_servicio);
        if(isset($_POST['ResultadoExamen'])){
            $resultado->attributes = $_POST['ResultadoExamen'];
            $this->validar(array_merge([$resultado],$detalleList));
            if($resultado->save()){
                foreach ($detalleList as $detalle){
                    $detalle->id_res = $resultado->id_res;
                    $detalle->save();
                }
                $detallePrestacion->realizado = true;
                $detallePrestacion->save();
                return $this->redirect(['list']);
            }
        }
        $this->render('createResultadoExamen',['detallePrestacion'=>$detallePrestacion,'resultado'=>$resultado,'detalleList'=>$detalleList]);
    }

    public function actionViewResultadoExamen($id_res = 0){
        $this->menu = OptionsMenu::menuExamen([],['examen','list']);

        $resultado = ResultadoExamen::model()->findByPk($id_res);
        $this->render('viewResultadoExamen',['resultado'=>$resultado]);
    }

    private function loadData(){
        $epList = [];
        if(isset($_POST['ExamenParametro'])){
            foreach($_POST['ExamenParametro'] as $epItem){
                $temp = new ExamenParametro();
                $temp->attributes = $epItem;
                $epList[]= $temp;
            }
        }
        return $epList;
    }

    private function loadForm($id_serv = 0){
        $formList = [];
        if(isset($_POST['DetalleResultado'])){
            foreach ($_POST['DetalleResultado'] as $item){
                $temp = new DetalleResultado();
                $temp->attributes = $item;
                $formList[]= $temp;
            }
        }
        else{
            $examen = ServExamen::model()->findByPk($id_serv);
            if($examen && $examen->examenParametros){
                foreach ($examen->examenParametros as $itemPar){
                    $temp = new DetalleResultado();
                    $temp->id_par = $itemPar->id_par;
                    $formList[]=$temp;
                }
            }
        }
        return $formList;
    }

    private function validar($lista = []){
        $flag = true;
        foreach ($lista as $item){
            $flag = $flag && $item->validate();
        }
        return $flag;
    }
}