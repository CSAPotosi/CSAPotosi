<?php

/**
 * This is the model class for table "cuenta_asiento".
 *
 * The followings are the available columns in table 'cuenta_asiento':
 * @property integer $id_cuenta_asiento
 * @property double $monto
 * @property boolean $tipo
 * @property integer $id_asiento
 * @property integer $id_cuenta
 *
 * The followings are the available model relations:
 * @property Asiento $idAsiento
 * @property Cuenta $idCuenta
 */
class CuentaAsiento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cuenta_asiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('monto, tipo, id_asiento, id_cuenta', 'required'),
			array('id_asiento, id_cuenta', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cuenta_asiento, monto, tipo, id_asiento, id_cuenta', 'safe', 'on'=>'search'),
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
			'idAsiento' => array(self::BELONGS_TO, 'Asiento', 'id_asiento'),
			'idCuenta' => array(self::BELONGS_TO, 'Cuenta', 'id_cuenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cuenta_asiento' => 'Id Cuenta Asiento',
			'monto' => 'Monto',
			'tipo' => 'Tipo',
			'id_asiento' => 'Id Asiento',
			'id_cuenta' => 'Id Cuenta',
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

		$criteria->compare('id_cuenta_asiento',$this->id_cuenta_asiento);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('id_asiento',$this->id_asiento);
		$criteria->compare('id_cuenta',$this->id_cuenta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CuentaAsiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
