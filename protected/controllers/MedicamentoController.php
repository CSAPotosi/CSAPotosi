<?php

class MedicamentoController extends Controller
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
                'roles' => array('medicamentoIndex'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('medicamentoUpdate'),
            ),
            array('allow',
                'actions' => array('getItemsAjax'),
                'roles' => array('medicamentoGetItemsAjax'),
            ),
            array('allow',
                'actions' => array('download'),
                'roles' => array('medicamentoDownload'),
            ),
            array('allow',
                'actions' => array('upload'),
                'roles' => array('medicamentoUpload'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuEspecialOptions([],['vademecum','medicamento_Index']);
		$this->render('index');
	}

	public function actionUpdate(){
		$uploadModel = new FileUploadForm('uploadMed');
		$this->render('update',['uploadModel'=>$uploadModel]);
	}

    public function actionGetItemsAjax($selectable = false){
        $param = '';
        if(isset($_POST['param']))
            $param = $_POST['param'];
        $mediList = Medicamento::model()->findAll([
            'condition' => 'nombre_med like :data OR codigo like :data',
            'params'=>[':data' => "%{$param}%"],
            'limit'=>10
        ]);
        $this->renderPartial('_tableMedicamento',['mediList' => $mediList,'selectable'=>$selectable]);
    }

	public function actionDownload(){
		Yii::import('ext.phpexcel.XPHPExcel');

		$titulos =['Medicamento','Forma farmaceutica','Concentracion','Clasificacion A.T.Q.','Uso Restringido'];
		$borde = array(
			'style' => 'medium',
			'color'=>['rgb'=>'FFFFFF']
		);

		$bordes = [
			'left'=>$borde,
			'right'=>$borde
		];

		$style_header = [
			'fill'=>[
				'type'=>'solid',
				'color'=>['rgb'=>'1D496D']
			],
			'font'=>[
				'name'=>'Arial',
				'bold'=>true,
				'size'=>10,
				'color'=>['rgb'=>'FFFFFF']
			],
			'alignment'=>[
				'horizontal'=>'center',
				'vertical'=>'center',
				'wrap'=>true
			],
		];

		$style_title = [
			'font'=>[
				'font'=>'Arial',
				'bold'=>true,
				'size'=>20
			],
			'alignment'=>[
				'horizontal'=>'center',
				'vertical'=>'center'
			]
		];

		$objPHPExcel = XPHPExcel::createPHPExcel();
		$objPHPExcel->getProperties()
			->setCreator("Clinica Santa Ana S.R.L.")
			->setTitle("Plantilla LINAME.")
			->setDescription("Plantilla para la actualizacion del Listado Nacional de Medicamentos.")
			->setKeywords("LINAME CSAPOTOSI");

		//** Incluidos **//
		$objPHPExcel->setActiveSheetIndex(0)->setTitle('Incluidos')
			->mergeCells('A2:H2')->setCellValue('A2','MEDICAMENTOS INCLUIDOS LINAME')
			->mergeCells('A4:C4')->setCellValue('A4','Codigo')
			->fromArray($titulos, NULL,	'D4');
		//obtener la hoja 1
		$sheet = $objPHPExcel->getActiveSheet();
		//cambiar ancho de columnas
		$sheet->getColumnDimensionByColumn(0)->setWidth(4);
		$sheet->getColumnDimensionByColumn(1)->setWidth(4);
		$sheet->getColumnDimensionByColumn(2)->setWidth(4);
		$sheet->getColumnDimensionByColumn(3)->setWidth(36);
		$sheet->getColumnDimensionByColumn(4)->setWidth(24);
		$sheet->getColumnDimensionByColumn(5)->setWidth(24);
		$sheet->getColumnDimensionByColumn(6)->setWidth(12);
		$sheet->getColumnDimensionByColumn(7)->setWidth(8);
		//cambiar alto de filas
		$sheet->getRowDimension(1)->setRowHeight(10);
		$sheet->getRowDimension(2)->setRowHeight(20);
		$sheet->getRowDimension(3)->setRowHeight(10);
		$sheet->getRowDimension(4)->setRowHeight(60);
		//Alinear textos
		$sheet->getStyle('A2')->applyFromArray($style_title);
		$sheet->getStyle('A4:H4')->applyFromArray($style_header);
		$sheet->getStyle('A4:C4')->getBorders()->applyFromArray($bordes);
		$sheet->getStyle('D4')->getBorders()->applyFromArray($bordes);
		$sheet->getStyle('E4')->getBorders()->applyFromArray($bordes);
		$sheet->getStyle('F4')->getBorders()->applyFromArray($bordes);
		$sheet->getStyle('G4')->getBorders()->applyFromArray($bordes);
		//$sheet->getStyle('A5:C3000')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$sheet->getStyle('A5');
		//** Excluidos **//
		$sheet2 = clone $objPHPExcel->setActiveSheetIndex(0);
		$sheet2->setTitle('Excluidos');
		$objPHPExcel->addSheet($sheet2);
		$sheet2 = $objPHPExcel->setActiveSheetIndex(1);
		$sheet2->setCellValue('A2','MEDICAMENTOS EXCLUIDOS LINAME');
		$sheet2->getStyle('A4:H4')->applyFromArray(['fill'=>['color'=>['rgb'=>'D44D48']]]);
		$sheet2->getStyle('A5');
		// Inicializar
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a clientâ€™s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="PLANTILLA_LINAME.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function actionUpload(){
		$uploadModel = new FileUploadForm('uploadMed');

		if(isset($_POST['FileUploadForm'])){
			$uploadModel->attributes = $_POST['FileUploadForm'];
			if($uploadModel->validate()){
				$uploadModel->medExcel = CUploadedFile::getInstance($uploadModel,'medExcel');
				$uploadModel->medExcel->saveAs('PLANTILLA_LINAME.'.$uploadModel->medExcel->extensionName);
				$this->loadData();
				return;
			}
			return $this->render('update',['uploadModel'=>$uploadModel]);

		}
	}


	public function loadData(){
		Yii::import('ext.phpexcel.XPHPExcel');

		$objPHPExcel = XPHPExcel::loadPHPExcel('PLANTILLA_LINAME.xls');
		$sheet = $objPHPExcel->setActiveSheetIndex(0);
		echo "<table>";
		foreach ($sheet->getRowIterator(5) as $row){
			$rowIndex = $row->getRowIndex();
			echo "<tr>";
				echo "<td>".$sheet->getCellByColumnAndRow(0,$rowIndex)->getValue()
					.$sheet->getCellByColumnAndRow(1,$rowIndex)->getValue()
					.$sheet->getCellByColumnAndRow(2,$rowIndex)->getValue()
					."</td>";
			echo "<td>{$sheet->getCellByColumnAndRow(3,$rowIndex)->getValue()}</td>";
			echo "<td>{$sheet->getCellByColumnAndRow(4,$rowIndex)->getValue()}</td>";
			echo "<td>{$sheet->getCellByColumnAndRow(5,$rowIndex)->getValue()}</td>";
			echo "<td>{$sheet->getCellByColumnAndRow(6,$rowIndex)->getValue()}</td>";
			echo "<td>{$sheet->getCellByColumnAndRow(6,$rowIndex)->getValue()}</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}