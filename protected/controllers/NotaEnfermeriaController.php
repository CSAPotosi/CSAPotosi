<?php

class NotaEnfermeriaController extends Controller
{
    private $_internacion = null;
	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','notasEnfermeria']);
        $neModel = new NotaEnfermeria();
		$this->render('index', ['iModel'=> $this->_internacion,'neModel'=>$neModel]);
	}

	public function actionCreate(){
        $nota = new NotaEnfermeria();
        if(isset($_POST['NotaEnfermeria'])){
            $nota->attributes = $_POST['NotaEnfermeria'];
            $nota->id_inter = $this->_internacion->id_inter;
            if($nota->save())
                return $this->redirect(['index','i_id'=>$this->_internacion->id_inter]);
        }

        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','notasEnfermeria']);
        return $this->render('index', ['iModel'=> $this->_internacion,'neModel'=>$nota]);
    }

    public function filters()
    {
        return [
            'internacionContext'
        ];
    }

    public function filterInternacionContext($filterChain){
        if(isset($_GET['i_id']))
            $this->loadInternacion($_GET['i_id']);
        else
            throw new CHttpException(404, 'No ha especificado una internacion valida, vuelva a intentarlo');
        $filterChain->run();
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