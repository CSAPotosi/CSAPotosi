<?php

/**
 * This is the model class for table "ciclo_contable".
 *
 * The followings are the available columns in table 'ciclo_contable':
 * @property integer $id_ciclo
 * @property integer $gestion
 * @property integer $mes_inicio
 * @property string $descripcion
 * @property boolean $activo
 *
 * The followings are the available model relations:
 * @property Asiento[] $asientos
 */
class CicloContable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ciclo_contable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gestion, mes_inicio', 'required'),
			array('gestion, mes_inicio', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>512),
			array('activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ciclo, gestion, mes_inicio, descripcion, activo', 'safe', 'on'=>'search'),
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
			'asientos' => array(self::HAS_MANY, 'Asiento', 'id_ciclo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ciclo' => 'Id Ciclo',
			'gestion' => 'Gestion',
			'mes_inicio' => 'Mes Inicio',
			'descripcion' => 'Descripcion',
			'activo' => 'Activo',
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

		$criteria->compare('id_ciclo',$this->id_ciclo);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('mes_inicio',$this->mes_inicio);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CicloContable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
