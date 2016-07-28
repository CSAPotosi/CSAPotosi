<?php
class FileUploadForm extends CFormModel{
	public $medExcel;

	public function rules()
	{
		return [
			['medExcel','file','types'=>'xls','safe'=>false,'on'=>'uploadMed']
		];
	}


}