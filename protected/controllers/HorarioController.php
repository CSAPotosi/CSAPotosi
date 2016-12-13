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
                'roles' => array('horarioCreate'),
            ),
            array('allow',
                'actions' => array('index'),
                'roles' => array('horarioIndex'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('horarioUpdate'),
            ),
            array('allow',
                'actions' => array('View'),
                'roles' => array('horarioView'),
            ),
            array('allow',
                'actions' => array('CreatePeriodo'),
                'roles' => array('horarioCreatePeriodo'),
            ),
            array('allow',
                'actions' => array('SetPeriodos'),
                'roles' => array('horarioSetPeriodos'),
            ),
            array('allow',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->menu = OptionsMenu::menuHorario([], ['horarios', 'Lista Horario']);
        $listHorario = Horario::model()->findAll();
        $this->render('index', array('listHorario' => $listHorario));
    }

    public function actionCreate()
    {
        $this->menu = OptionsMenu::menuHorario([], ['horarios', 'Crear Horario']);
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
        $this->menu = OptionsMenu::menuHorario(['id_horario' => $id], ['horario', 'Actualizar Horario']);
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
        $this->menu = OptionsMenu::menuHorario(['id_horario' => $id], ['horario', 'Crear Periodo']);
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