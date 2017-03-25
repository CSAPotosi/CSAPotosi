<?php

class ExamenController extends Controller
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
                'roles' => array('examenIndex'),
            ),
            array('allow',
                'actions' => array('list'),
                'roles' => array('examenList'),
            ),
            array('allow',
                'actions' => array('examen'),
                'roles' => array('examenExamen'),
            ),
            array('allow',
                'actions' => array('adminExamenParams'),
                'roles' => array('examenAdminExamenParams'),
            ),
            array('allow',
                'actions' => array('getParamsTable'),
                'roles' => array('examenGetParamsTable'),
            ),
            array('allow',
                'actions' => array('createResultadoExamen'),
                'roles' => array('examenCreateResultadoExamen'),
            ),
            array('allow',
                'actions' => array('viewResultadoExamen'),
                'roles' => array('examenViewResultadoExamen'),
            ),
            array('allow',
                'actions' => array('viewResultadoExamenPDF'),
                'roles' => array('examenViewResultadoExamenPDF'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuExamen([],['examen','examen_Index']);

        $examenList = DetallePrestacion::model()->findAll([
            'condition' => 'NOT realizado',
            'order'=>'fecha_solicitud DESC'
        ]);
		$this->render('index',['examenList'=>$examenList]);
	}

    public function actionList(){
        $this->menu = OptionsMenu::menuExamen([],['examen','examen_List']);

        $examenList = DetallePrestacion::model()->findAll([
            'condition' => 'realizado',
            'order'=>'fecha_solicitud DESC'
        ]);
        $this->render('list',['examenList'=>$examenList]);
    }

    public function actionExamen(){
        $this->menu = OptionsMenu::menuExamen([],['examen','examen_Examen']);

        $examenList = ServExamen::model()->with([
            'categoria'=>['condition'=>'tipo_ex = 1']
        ])->findAll();
        $this->render('examen',['examenList'=>$examenList]);
    }

    public function actionAdminExamenParams($id_ex=0){
        $this->menu = OptionsMenu::menuExamen([],['examen','examen_Examen']);

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

    public function actionGetParamsTable(){
        $paramsList = Parametro::model()->findAll(['condition'=>'tipo_par = 0']);
        $this->renderPartial('_paramsTable',['paramsList'=>$paramsList]);
    }

    public function actionCreateResultadoExamen($id_det_pres = 0){
        $this->menu = OptionsMenu::menuExamen([],['examen','examen_Index']);

        $detallePrestacion = DetallePrestacion::model()->findByPk($id_det_pres);
        $resultado = new ResultadoExamen();
        $resultado->id_det_pres = $id_det_pres;
        $detalleList = $this->loadForm($detallePrestacion->id_servicio);
        if(isset($_POST['ResultadoExamen'])){
            $resultado->attributes = $_POST['ResultadoExamen'];
            $this->validar(array_merge($detalleList,[$resultado]));
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
        $this->menu = OptionsMenu::menuExamen([],['examen','examen_List']);

        $resultado = ResultadoExamen::model()->findByPk($id_res);
        $this->render('viewResultadoExamen',['resultado'=>$resultado]);
    }

    public function actionViewResultadoExamenPDF($id_res = 0){
        $resultado = ResultadoExamen::model()->findByPk($id_res);
        if($resultado){
            spl_autoload_register(array('YiiBase', 'autoload'));
            $pdf = new MYPDF('I', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle("Reporte Asistencia");
            //cabecera 1 logo santa ana
            $pdf->cabecera1();
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(80, 80, 80);
            $pdf->AddPage();
            $pdf->usuario();
            $pdf->cabeceraPaciente($resultado->detallePrestacion->prestacion->historial->paciente);
            $pdf->titulo('EXAMEN DE '.strtoupper($resultado->detallePrestacion->servicio->nombre_serv));
            $pdf->SetFillColor(230);
            $pdf->setTextColor(50);

            if($resultado->detalleResultados){
                $pdf->SetFont(null,'B',9);
                $pdf->Cell(62,7,'PARAMETRO',0,0,'C',false,'',1);
                $pdf->Cell(62,7,'VALOR OBTENIDO',0,0,'C',false,'',1);
                $pdf->Cell(62,7,'VALORES DE REFERENCIA',0,0,'C',false,'',1);
                $pdf->Ln();
                $pdf->SetFont('','',8);
                $fill = false;
                foreach ($resultado->detalleResultados as $detalle){
                    $pdf->Cell(62,7,$detalle->parametro->nombre_par,0,0,'R',$fill,'',1);
                    $pdf->Cell(62,7,$detalle->valor_res." ({$detalle->parametro->ext_par})",0,0,'C',$fill,'',1);
                    $pdf->Cell(62,7,$detalle->parametro->val_ref,0,0,'L',$fill,'',1);
                    $pdf->Ln();
                    $fill = !$fill;
                }
            }
            $pdf->SetFont(null,'B',9);
            $pdf->Cell(50,7,'DIAGNOSTICO:',0,0,'R',false,'',1);
            $pdf->SetFont(null,'',8);
            $pdf->Cell(136,7,$resultado->diagnostico_res,0,0,'L',false,'',1);
            $pdf->Ln();
            $pdf->SetFont(null,'B',9);
            $pdf->Cell(50,7,'OBSERVACIONES:',0,0,'R',false,'',1);
            $pdf->SetFont(null,'',8);
            $pdf->Cell(136,7,$resultado->diagnostico_res,0,0,'L',false,'',1);
            $pdf->lastPage();
            $pdf->customOutput('RESULTADO - EXAMEN DE '.strtoupper($resultado->detallePrestacion->servicio->nombre_serv));
            //Close and output PDF document
            //$pdf->Output('filename.pdf', 'I');
        }
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