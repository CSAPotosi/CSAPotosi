<?php

/**
 * This is the model class for table "cargo".
 *
 * The followings are the available columns in table 'cargo':
 * @property integer $id_cargo
 * @property string $nombre_cargo
 * @property string $descripcion_cargo
 * @property integer $id_unidad
 * @property integer $id_horario
 *
 * The followings are the available model relations:
 * @property AsignacionEmpleado[] $asignacionEmpleados
 * @property Unidad $idUnidad
 * @property Horario $idHorario
 */
class Cargo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cargo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_cargo', 'required'),
			array('id_unidad, id_horario', 'numerical', 'integerOnly'=>true),
			array('nombre_cargo', 'length', 'max'=>32),
			array('descripcion_cargo', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cargo, nombre_cargo, descripcion_cargo, id_unidad, id_horario', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			'asignacionEmpleados' => array(self::HAS_MANY, 'AsignacionEmpleado', 'id_cargo'),
			'asignacionReporte' => array(self::HAS_MANY, 'AsignacionEmpleado', 'id_cargo', 'condition' => 'fecha_fin is null'),
			'unidad' => array(self::BELONGS_TO, 'Unidad', 'id_unidad'),
			'horario' => array(self::BELONGS_TO, 'Horario', 'id_horario'),
            
        );
    }

	public function attributeLabels()
	{
		return array(
			'id_cargo' => 'Id Cargo',
			'nombre_cargo' => 'Nombre Cargo',
			'descripcion_cargo' => 'Descripcion Cargo',
			'id_unidad' => 'Id Unidad',
			'id_horario' => 'Id Horario',
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

		$criteria->compare('id_cargo',$this->id_cargo);
		$criteria->compare('nombre_cargo',$this->nombre_cargo,true);
		$criteria->compare('descripcion_cargo',$this->descripcion_cargo,true);
		$criteria->compare('id_unidad',$this->id_unidad);
		$criteria->compare('id_horario',$this->id_horario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cargo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getHorario()
	{
		return CHtml::listData(Horario::model()->findAll(), 'id_horario', 'nombre_horario');
	}
}
