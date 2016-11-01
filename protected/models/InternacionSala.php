<?php

/**
 * This is the model class for table "internacion_sala".
 *
 * The followings are the available columns in table 'internacion_sala':
 * @property integer $id_inter
 * @property integer $id_sala
 * @property string $fecha_entrada
 * @property string $fecha_salida
 *
 * The followings are the available model relations:
 * @property Internacion $idInter
 * @property Sala $idSala
 */
class InternacionSala extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'internacion_sala';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_inter, id_sala', 'required'),
			array('id_inter, id_sala', 'numerical', 'integerOnly'=>true),
			array('fecha_entrada,fecha_salida', 'safe'),
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
			'internacion' => array(self::BELONGS_TO, 'Internacion', 'id_inter'),
			'sala' => array(self::BELONGS_TO, 'Sala', 'id_sala'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_inter' => 'Id Inter',
			'id_sala' => 'Id Sala',
			'fecha_entrada' => 'Fecha Entrada',
			'fecha_salida' => 'Fecha Salida',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InternacionSala the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
