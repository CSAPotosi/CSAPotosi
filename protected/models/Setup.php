<?php

/**
 * This is the model class for table "setup".
 *
 * The followings are the available columns in table 'setup':
 * @property string $clave_se
 * @property string $valor_se
 * @property string $descripcion_se
 */
class Setup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clave_se', 'required'),
			array('clave_se', 'length', 'max'=>128),
			array('valor_se, descripcion_se', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('clave_se, valor_se, descripcion_se', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'clave_se' => 'Clave Se',
			'valor_se' => 'Valor Se',
			'descripcion_se' => 'Descripcion Se',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Setup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
