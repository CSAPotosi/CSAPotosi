<?php

/**
 * This is the model class for table "ciclo_contable".
 *
 * The followings are the available columns in table 'ciclo_contable':
 * @property integer $id_ciclo
 * @property integer $gestion
 * @property integer $dia_inicio
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
	public $anios = array(2010=>'2010',2011=>'2011',2012=>'2012',2013=>'2013',2014=>'2014',2015=>'2015',2016=>'2016',2017=>'2017',2018=>'2018',2019=>'2019',2020=>'2020',2021=>'2021',2022=>'2022',2023=>'2023',2024=>'2024',2025=>'2025',2026=>'2026',2027=>'2027',2028=>'2028',2029=>'2029',2030=>'2030');
	public $meses = array(1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio', 7=>'Julio', 8=>'Agosto', 9=>'Septiembre', 10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre');


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
			array('gestion, dia_inicio', 'required'),
			array('gestion', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>512),
			array('activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ciclo, gestion, descripcion, activo', 'safe', 'on'=>'search'),
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
			'dia_inicio' => 'Dia de Inicio',
			'descripcion' => 'Descripcion',
			'activo' => 'Estado',
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
		$criteria->compare('dia_inicio',$this->dia_inicio);
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

	public static function cicloActual()
	{
		$ciclo = CicloContable::model()->find("activo=true");
		return $ciclo;
	}

	public function getAnios()
	{
		return $this->anios;
	}

	public function getMeses()
	{
		return $this->meses;
	}
	/*
	public function getMes()
	{
		return $this->meses[$this->mes_inicio];
	}
	*/
}
