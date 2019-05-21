<?php

class InternacionController extends Controller{
    private $_historial = null;
    private $_internacion = null;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'historialContext + createIngreso',
            'internacionContext - createIngreso'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index'),
                'roles' => array('internacionIndex'),
            ),
            array('allow',
                'actions' => array('createIngreso'),
                'roles' => array('internacionCreateIngreso'),
            ),
            array('allow',
                'actions' => array('alta'),
                'roles' => array('internacionAlta'),
            ),
            array('allow',
                'actions' => array('changeSala'),
                'roles' => array('internacionChangeSala'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','internacion_Index']);

		$this->render('index',['internacionModel'=>$this->_internacion]);
	}

	public function actionCreateIngreso(){
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial],['historial','internacion_CreateIngreso']);

		$internacionModel = new Internacion('ingreso');
		$internacionModel->motivo_ingreso = 0;$internacionModel->procedencia_ingreso = 0;
        $internacionModel->estado = 1;
		$internacionModel->id_historial = $this->_historial->id_historial;
		if(isset($_POST['Internacion'])){
			$internacionModel->attributes = $_POST['Internacion'];
			if($internacionModel->save()){
                $tempPaciente = $internacionModel->historial->paciente;
                $tempPaciente->estado_paciente = 2;//internado
                $tempPaciente->save();
                $this->addSala($internacionModel->id_inter,$internacionModel->fecha_ingreso);
                $this->redirect(['index','i_id'=>$internacionModel->id_inter]);
            }
		}
		$this->render('createIngreso',['internacionModel'=>$internacionModel, 'historialModel'=>$this->_historial]);
	}

    public function actionAlta(){
        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','internacion_Alta']);
        $iModel =$this->_internacion;
        $iModel->scenario = 'alta';
        $iModel->estado = 0;
        if(isset($_POST['Internacion'])){
            $iModel->attributes = $_POST['Internacion'];
            if($iModel->save()){
                $salaTemp = $iModel->salaActual;
                if($salaTemp){
                    $salaTemp->sala->estado_sala = 3;
                    $salaTemp->sala->save();
                    $salaTemp->fecha_salida =date('Y-m-d H:i:s');
                    $salaTemp->save();
                }
                $iModel->historial->paciente->estado_paciente = 1;
                $iModel->historial->paciente->save();
                $this->redirect(['historialMedico/index','id_paciente'=>$iModel->id_historial]);
            }
        }
        $this->render('alta',['internacionModel'=>$iModel]);
    }

    public function actionChangeSala(){
        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','internacion_ChangeSala']);
        if(isset($_POST['InternacionSala'])){
            $temp = new InternacionSala();
            $temp->attributes = $_POST['InternacionSala'];
            $temp->id_inter = $this->_internacion->id_inter;
            if($temp->validate())
                $this->addSala($this->_internacion->id_inter,$temp->fecha_entrada);
        }
        $this->render('changeSala',['internacionModel'=>$this->_internacion]);
    }

    private function addSala($inter_id = 0,$fecha = null){
        $interModel = Internacion::model()->findByPk($inter_id);
        if($fecha != null&& $interModel != null && isset($_POST['InternacionSala'])){
            $salaActual = $interModel->salaActual;
            if($salaActual!=null){
                $salaActual->sala->estado_sala = 3;
                $salaActual->sala->save();
                $salaActual->fecha_salida = $fecha;
                $salaActual->save();
            }
            $interSalaModel = new InternacionSala();
            $interSalaModel->attributes = $_POST['InternacionSala'];
            if($interSalaModel->id_sala!=0){
                $interSalaModel->id_inter = $interModel->id_inter;
                $interSalaModel->fecha_entrada = $fecha;
                if($interSalaModel->save()){
                    $interSalaModel->sala->estado_sala = 2;
                    $interSalaModel->sala->save();
                }
            }
        }
    }


	//probando con filtros
	public function filterHistorialContext($filterChain){
		if(isset($_GET['h_id'])){
			$this->loadHistorial($_GET['h_id']);
		}
		else
			throw new CHttpException(404, 'No ha especificado un historial valido, vuelva a intentarlo');
		$filterChain->run();
	}

    public function filterInternacionContext($filterChain){
        if(isset($_GET['i_id']))
            $this->loadInternacion($_GET['i_id']);
        else
            throw new CHttpException(404, 'No ha especificado una internacion valida, vuelva a intentarlo');
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

    protected function loadInternacion($internacionId){
        if($this->_internacion == null){
            $this->_internacion = Internacion::model()->findByPk($internacionId);
            if($this->_internacion == null)
                throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
        }
        return $this->_internacion;
    }


}