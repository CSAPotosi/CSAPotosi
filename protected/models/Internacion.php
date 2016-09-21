<?php

/**
 * This is the model class for table "internacion".
 *
 * The followings are the available columns in table 'internacion':
 * @property integer $id_inter
 * @property integer $id_historial
 * @property string $fecha_ingreso
 * @property integer $motivo_ingreso
 * @property string $observacion_ingreso
 * @property integer $procedencia_ingreso
 * @property string $fecha_alta
 * @property integer $tipo_alta
 * @property string $observacion_alta
 * @property string $fecha_egreso
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property HistorialMedico $historial
 */
class Internacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'internacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_historial, fecha_ingreso, motivo_ingreso', 'required','on'=>'ingreso'),
			array('id_historial, motivo_ingreso, procedencia_ingreso, tipo_alta, estado', 'numerical', 'integerOnly'=>true),
			array('observacion_ingreso, observacion_alta', 'length', 'max'=>256),
			array('fecha_alta, fecha_egreso', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'historial' => [self::BELONGS_TO, 'HistorialMedico', 'id_historial'],
            'salaActual'=>[self::HAS_ONE,'InternacionSala','id_inter','condition'=> 'fecha_salida is null']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_inter' => 'Id Inter',
			'id_historial' => 'Id Historial',
			'fecha_ingreso' => 'Fecha Ingreso',
			'motivo_ingreso' => 'Motivo Ingreso',
			'observacion_ingreso' => 'Observacion Ingreso',
			'procedencia_ingreso' => 'Procedencia Ingreso',
			'fecha_alta' => 'Fecha Alta',
			'tipo_alta' => 'Tipo Alta',
			'observacion_alta' => 'Observacion Alta',
			'fecha_egreso' => 'Fecha Egreso',
			'estado' => 'Estado',
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Internacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getMotivo(){
		return [
			'0'=>'ENFERMEDAD',
			'1'=>'ACCIDENTE',
			'2'=>'PARTO'
		];
	}

	public static function getProcedencia(){
		return [
			'0'=>'CONSULTA EXTERNA',
			'1'=>'EMERGENCIA',
			'2'=>'EXTERNO'
		];
	}
}
