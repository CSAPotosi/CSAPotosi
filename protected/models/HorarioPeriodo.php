<?php

/**
 * This is the model class for table "horario_periodo".
 *
 * The followings are the available columns in table 'horario_periodo':
 * @property integer $id_horario_periodo
 * @property integer $id_horario
 * @property integer $id_periodo
 * @property integer $dia
 *
 * The followings are the available model relations:
 * @property Horario $idHorario
 * @property Periodo $idPeriodo
 */
class HorarioPeriodo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'horario_periodo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_horario, id_periodo, dia', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_horario_periodo, id_horario, id_periodo, dia', 'safe', 'on'=>'search'),
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
			'horario' => array(self::BELONGS_TO, 'Horario', 'id_horario'),
			'periodo' => array(self::BELONGS_TO, 'Periodo', 'id_periodo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_horario_periodo' => 'Id Horario Periodo',
			'id_horario' => 'Id Horario',
			'id_periodo' => 'Id Periodo',
			'dia' => 'Dia',
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

		$criteria->compare('id_horario_periodo',$this->id_horario_periodo);
		$criteria->compare('id_horario',$this->id_horario);
		$criteria->compare('id_periodo',$this->id_periodo);
		$criteria->compare('dia',$this->dia);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HorarioPeriodo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
