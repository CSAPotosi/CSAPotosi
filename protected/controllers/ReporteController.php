<?php

class ReporteController extends Controller
{
    public function filters(){
        return ['accessControl'];
    }

    public function accessRules(){
        return [
            ['allow',
                'actions'=>['myIndex'],
                'users'=>['@']
            ],
            array('allow',
                'actions' => array('index'),
                'roles' => array('reporteIndex'),
            ),
            array('allow',
                'actions' => array('view'),
                'roles' => array('reporteView'),
            ),
            ['deny',
                'users'=>['*']
            ]
        ];
    }

	public function actionIndex()
	{
        $fec_ini = isset($_POST['fec_ini'])?$_POST['fec_ini']:date('d/m/Y');
        $fec_fin = isset($_POST['fec_fin'])?$_POST['fec_fin']:date('d/m/Y');

        $reportes = AuditReport::model()->findAll([
            'condition'=>'fecha_report::DATE between :fec_ini and :fec_fin',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin],
            'order'=>'fecha_report desc'
        ]);

		$this->render('index',['reportes'=>$reportes, 'fec_ini'=>$fec_ini, 'fec_fin'=>$fec_fin]);
	}

    public function actionMyIndex(){
        $fec_ini = isset($_POST['fec_ini'])?$_POST['fec_ini']:date('d/m/Y');
        $fec_fin = isset($_POST['fec_fin'])?$_POST['fec_fin']:date('d/m/Y');
        $reportes = AuditReport::model()->findAll([
            'condition'=>'user_id = :user_id and fecha_report::DATE between :fec_ini and :fec_fin',
            'params'=>[':user_id'=>Yii::app()->user->id, ':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin],
            'order'=>'fecha_report desc'
        ]);
        $this->render('index',['reportes'=>$reportes, 'fec_ini'=>$fec_ini, 'fec_fin'=>$fec_fin]);
    }

	public function actionView($id = 0){
        $reporte = AuditReport::model()->findByPk($id);
        if($reporte){
            $content = $reporte->content_report;
            header("Content-type: application/pdf");
            echo base64_decode($content);
        }
        else
            echo 'No hay nada';
    }
}