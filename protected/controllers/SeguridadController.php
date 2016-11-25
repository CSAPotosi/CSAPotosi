<?php

class SeguridadController extends Controller
{
	public function actionAudit()
	{
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $audit = Yii::app()->db->createCommand()
            ->from('audit.logged_actions')
            ->select('*')
            ->where('action_tstamp::DATE between :fec_ini and :fec_fin',[':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin])
            ->queryAll();
        return $this->render('audit',['audit'=>$audit,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
	}

    public function actionAuditTxt(){
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $audit = Yii::app()->db->createCommand()
            ->from('audit.logged_actions')
            ->select('*')
            ->where('action_tstamp::DATE between :fec_ini and :fec_fin',[':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin])
            ->queryAll();

        header('Content-Disposition: attachment; filename="audit.txt"');
        header('Content-Type:text/plain; ');

        echo 'table||fecha||accion||original||nuevo||consulta'.PHP_EOL."";
        for($i = 0;$i<5;$i++)
        foreach ($audit as $au){
            echo $au['table_name'].'||'
                .date('d/m/Y H:i:s',strtotime($au['action_tstamp'])).'||'
                .$au['action'].'||'
                .$au['original_data'].'||'
                .$au['new_data'].'||'
                .$au['query'].PHP_EOL."";
        }
    }

}