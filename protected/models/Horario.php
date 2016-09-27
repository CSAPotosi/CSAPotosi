<?php

/**
 * This is the model class for table "horario".
 *
 * The followings are the available columns in table 'horario':
 * @property integer $id_horario
 * @property string $nombre_horario
 * @property string $descripcion
 * @property integer $ciclo_total
 *
 * The followings are the available model relations:
 * @property Cargo $cargo0
 * @property HorarioPeriodo[] $horarioPeriodos
 */
class Horario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'horario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_horario', 'required'),
			array('ciclo_total', 'numerical', 'integerOnly'=>true),
			array('nombre_horario, descripcion', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_horario, nombre_horario, descripcion, ciclo_total, cargo', 'safe', 'on'=>'search'),
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
			'cargo' => array(self::BELONGS_TO, 'Cargo', 'cargo'),
			'horarioPeriodos' => array(self::HAS_MANY, 'HorarioPeriodo', 'id_horario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_horario' => 'Id Horario',
			'nombre_horario' => 'Nombre Horario',
			'descripcion' => 'Descripcion',
			'ciclo_total' => 'Ciclo Total',
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

		$criteria->compare('id_horario',$this->id_horario);
		$criteria->compare('nombre_horario',$this->nombre_horario,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('ciclo_total',$this->ciclo_total);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Horario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
