<?php

/**
 * This is the model class for table "periodo".
 *
 * The followings are the available columns in table 'periodo':
 * @property integer $id_periodo
 * @property string $hora_entrada
 * @property integer $inicio_entrada
 * @property integer $fin_entrada
 * @property string $hora_salida
 * @property integer $inicio_salida
 * @property integer $fin_salida
 * @property integer $tolerancia
 * @property integer $tipo_periodo
 *
 * The followings are the available model relations:
 * @property HorarioPeriodo[] $horarioPeriodos
 */
class Periodo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'periodo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hora_entrada, hora_salida', 'required'),
			array('inicio_entrada, fin_entrada, inicio_salida, fin_salida, tolerancia, tipo_periodo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_periodo, hora_entrada, inicio_entrada, fin_entrada, hora_salida, inicio_salida, fin_salida, tolerancia, tipo_periodo', 'safe', 'on'=>'search'),
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
			'horarioPeriodos' => array(self::HAS_MANY, 'HorarioPeriodo', 'id_periodo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_periodo' => 'Id Periodo',
			'hora_entrada' => 'Hora Entrada',
			'inicio_entrada' => 'Inicio Entrada',
			'fin_entrada' => 'Fin Entrada',
			'hora_salida' => 'Hora Salida',
			'inicio_salida' => 'Inicio Salida',
			'fin_salida' => 'Fin Salida',
			'tolerancia' => 'Tolerancia',
			'tipo_periodo' => 'Tipo Periodo',
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

		$criteria->compare('id_periodo',$this->id_periodo);
		$criteria->compare('hora_entrada',$this->hora_entrada,true);
		$criteria->compare('inicio_entrada',$this->inicio_entrada);
		$criteria->compare('fin_entrada',$this->fin_entrada);
		$criteria->compare('hora_salida',$this->hora_salida,true);
		$criteria->compare('inicio_salida',$this->inicio_salida);
		$criteria->compare('fin_salida',$this->fin_salida);
		$criteria->compare('tolerancia',$this->tolerancia);
		$criteria->compare('tipo_periodo',$this->tipo_periodo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Periodo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
