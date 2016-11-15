<?php
class PacienteController extends Controller
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
				'roles' => array('createPaciente'),
			),
			array('allow',
				'actions' => array('index', 'GetPatientListAjax', 'DetallePaciente', 'Createpdf'),
				'roles' => array('indexPaciente'),
			),
			array('allow',
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuPaciente([],['pacientes','index']);
		$this->render('index');
	}

	//AJAX
	public function actionGetPatientListAjax(){
		$page=$_POST['page']*Yii::app()->params['itemListLimit'];
		$query=$_POST['query'];
		$status=$_POST['status'];
		$pacienteList=Paciente::getPatientList($page,$query,$status);
		$this->renderPartial('_patientListView',['pacienteList'=>$pacienteList]);
	}

    public function actionGetMinimalListAjax(){
        $pacienteList = Paciente::model()->findAll([
            'limit'=>10
        ]);
        $this->renderPartial('_minimalPatientListView',['pacienteList'=> $pacienteList]);
    }

	public function actionCreate()
	{
        $this->menu = OptionsMenu::menuPaciente([],['pacientes','create']);
		$modelPerson = new PersonaForm();
		if (isset($_POST['PersonaForm'])) {
			$modelPerson->setAttributes($_POST['PersonaForm'], false);
			$id_paciente = $modelPerson->savePaciente();
			if ($id_paciente != 0)
				$this->redirect(["historialMedico/index", 'id_paciente' => $id_paciente]);
		}
		$this->render('create', array('modelPerson' => $modelPerson));
	}

	public function actionDetallePaciente($id)
	{
		$paciente = Paciente::model()->findByPk($id);
		$this->render('detallePaciente', ['paciente' => $paciente]);
	}

	public function actionUpdate($id)
	{

	}

	public function actionCreatepdf()
	{
		spl_autoload_register(array('YiiBase', 'autoload'));
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);

		$pdf->SetTitle("Selling Report -2013");
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Selling Report -2013", "selling report for Jun- 2013");
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetFont('helvetica', '', 8);
		$pdf->SetTextColor(80, 80, 80);
		$pdf->AddPage();

		//Write the html
		$html = "<div style='margin-bottom:15px;'>This is testing HTML.</div>";
		//Convert the Html to a pdf document
		$pdf->writeHTML($html, true, false, true, false, '');

		$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)'); //TODO:you can change this Header information according to your need.Also create a Dynamic Header.

		// data loading
		$data = $pdf->LoadData(Yii::getPathOfAlias('ext.tcpdf.examples.data') . DIRECTORY_SEPARATOR . 'table_data_demo.txt'); //This is the example to load a data from text file. You can change here code to generate a Data Set from your model active Records. Any how we need a Data set Array here.
		// print colored table
		$pdf->ColoredTable($header, $data);
		// reset pointer to the last page
		$pdf->lastPage();

		//Close and output PDF document
		$pdf->Output('filename.pdf', 'I');
		Yii::app()->end();

	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}