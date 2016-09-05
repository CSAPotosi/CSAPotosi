<?php

class HorarioController extends Controller
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
                'actions' => array('create'),
                'roles' => array('createHorario'),
            ),
            array('allow',
                'actions' => array('index'),
                'roles' => array('indexHorario'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('updateHorario'),
            ),
            array('allow',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionindex()
    {
        $listHorario = Horario::model()->findAll();
        $this->render('index', array('listHorario' => $listHorario));
    }

    public function actionCreate()
    {
        $modelHorario = new Horario();
        if (isset($_POST['Horario'])) {
            $modelHorario->attributes = $_POST['Horario'];
            if ($modelHorario->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('modelHorario' => $modelHorario));
    }

    public function actionUpdate($id)
    {
        $modelHorario = Horario::model()->findByPk($id);
        if (isset($_POST['Horario'])) {
            $modelHorario->attributes = $_POST['Horario'];
            if ($modelHorario->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('modelHorario' => $modelHorario));
    }

    public function actionView($id){

        $horarioModel = Horario::model()->findByPk($id);
        $periodoModel = new Periodo();
        $this->render('view',['horarioModel'=>$horarioModel, 'periodoModel'=>$periodoModel]);
    }

    public function actionCreatePeriodo($id){
        $horarioModel = Horario::model()->findByPk($id);
        $periodoModel = new Periodo();

        if(isset($_POST['Periodo'])){
            $periodoModel->attributes = $_POST['Periodo'];
            if($periodoModel->save())
                $this->redirect(['view','id'=>$id]);
        }

        $this->render('view',['horarioModel'=>$horarioModel, 'periodoModel'=>$periodoModel]);
    }

    public function actionSetPeriodos($id){
        $horarioModel = Horario::model()->findByPk($id);
        if(isset($_POST['HorarioPeriodo'])){
            foreach ($horarioModel->horarioPeriodos as $itemHP)
                $itemHP->delete();

            foreach ($_POST['HorarioPeriodo'] as $itemHP){
                $hpModel = new HorarioPeriodo();
                $hpModel->attributes = $itemHP;
                $hpModel->id_horario = $horarioModel->id_horario;
                $hpModel->save();
            }
        }
        $this->redirect(['view','id'=>$id]);
    }
}