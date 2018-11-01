<?php

class CsvImportForm extends CFormModel
{
	public $file;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file', 'file', 
         	'types'=>'csv',
            'maxSize'=>1024 * 1024 * 1, // 1MB
            'tooLarge'=>'The file was larger than 1MB. Please upload a smaller file.',
            'allowEmpty' => false
         ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'file' => 'Seleccione el Archivo CSV',
		);
	}
}