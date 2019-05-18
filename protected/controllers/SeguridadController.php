<?php
class SeguridadController extends Controller
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
                'actions' => array('audit'),
                'roles' => array('seguridadAudit'),
            ),
            array('allow',
                'actions' => array('auditTxt'),
                'roles' => array('seguridadAuditTxt'),
            ),
            array('allow',
                'actions' => array('indexBackup'),
                'roles' => array('seguridadIndexBackup'),
            ),
            array('allow',
                'actions' => array('createBackup'),
                'roles' => array('seguridadCreateBackup'),
            ),
            array('allow',
                'actions' => array('cargarBackup'),
                'roles' => array('seguridadCargarBackup'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

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
    public function actionindexBackup()
    {
        $setup = Setup::model()->findByPk('se_postgres_dir');
        if(file_exists($setup->valor_se)){
            $backups = opendir('Backups/');
            $this->render('indexBackup', ['backups' => $backups]);
        }
        else
            $this->render('errorBackup');
    }

    public function actionCreateBackup()
    {
        $setup = Setup::model()->findByPk('se_postgres_dir');
        if(file_exists($setup->valor_se)){
            $user = Yii::app()->getComponents(false)['db']->username;
            $pass = Yii::app()->getComponents(false)['db']->password;

            $ruta = YiiBase::getPathOfAlias('webroot') . "/Backups/SantaAna-" . strtotime(date('Y-m-d H:i:s')) . ".backup";
            putenv("PGPASSWORD={$pass}");
            $dumpcmd = array($setup->valor_se, "-U", $user, "-F", "t", "-f", $ruta, "csapotosi_db");
            var_dump(join(' ', $dumpcmd));
            Yii::app()->end();
            exec(join(' ', $dumpcmd), $cmdout, $cmdresult);
            putenv("PGPASSWORD");
            $this->redirect(['indexBackup']);
        }
        else
            $this->render('errorBackup');
    }
    public function actionCargarBackup($id)
    {
        $ruta = YiiBase::getPathOfAlias('webroot') . "/Backups/SantaAna-" . $id . ".backup";
        header("Content-disposition: attachment; filename=SantaAna-" . $id . ".backup");
        header("Content-type: MIME");
        readfile("$ruta");
        $this->redirect(['indexBackup']);
    }
}