<?php

/**
 * This is the model class for table "medicamento".
 *
 * The followings are the available columns in table 'medicamento':
 * @property string $codigo
 * @property string $nombre_med
 * @property string $forma_farm
 * @property string $concentracion
 * @property string $ATQ
 * @property boolean $restringido
 * @property integer $estado_med
 */
class Medicamento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'medicamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, nombre_med, forma_farm, concentracion, ATQ', 'required'),
			array('estado_med', 'numerical', 'integerOnly'=>true),
			array('codigo, ATQ', 'length', 'max'=>8),
			array('nombre_med, forma_farm', 'length', 'max'=>64),
			array('concentracion', 'length', 'max'=>32),
			array('restringido', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, nombre_med, forma_farm, concentracion, ATQ, restringido, estado_med', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
			'nombre_med' => 'Nombre Med',
			'forma_farm' => 'Forma Farm',
			'concentracion' => 'Concentracion',
			'ATQ' => 'Atq',
			'restringido' => 'Restringido',
			'estado_med' => 'Estado Med',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nombre_med',$this->nombre_med,true);
		$criteria->compare('forma_farm',$this->forma_farm,true);
		$criteria->compare('concentracion',$this->concentracion,true);
		$criteria->compare('ATQ',$this->ATQ,true);
		$criteria->compare('restringido',$this->restringido);
		$criteria->compare('estado_med',$this->estado_med);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Medicamento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
