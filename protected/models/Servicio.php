<?php

/**
 * This is the model class for table "servicio".
 *
 * The followings are the available columns in table 'servicio':
 * @property integer $id_serv
 * @property string $cod_serv
 * @property string $nombre_serv
 * @property string $unidad_medida
 * @property integer $tipo_cobro
 * @property string $fecha_creacion
 * @property string $fecha_edicion
 * @property boolean $activo
 * @property integer $id_entidad
 *
 * The followings are the available model relations:
 * @property Precio[] $precios
 * @property ServExamen $servExamen
 * @property Entidad $idEntidad
 * @property ServClinico $servClinico
 * @property ServTipoSala $servTipoSala
 */
class Servicio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servicio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_serv, nombre_serv, id_entidad', 'required'),
			array('tipo_cobro, id_entidad', 'numerical', 'integerOnly' => true),
			array('cod_serv', 'length', 'max'=>8),
			array('nombre_serv', 'length', 'max'=>64),
			array('unidad_medida', 'length', 'max'=>32),
			array('fecha_creacion, fecha_edicion, activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_serv, cod_serv, nombre_serv, unidad_medida, tipo_cobro, fecha_creacion, fecha_edicion, activo, id_entidad', 'safe', 'on' => 'search'),
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
			'historialPrecio' => array(self::HAS_MANY, 'Precio', 'id_serv'),
			'precio' => array(self::HAS_ONE, 'Precio', 'id_serv', 'condition' => 'activo = TRUE'),
			'servExamen' => array(self::HAS_ONE, 'ServExamen', 'id_serv'),
			'idEntidad' => array(self::BELONGS_TO, 'Entidad', 'id_entidad'),
			'servClinico' => array(self::HAS_ONE, 'ServClinico', 'id_serv'),
			'servTipoSala' => array(self::HAS_ONE, 'ServTipoSala', 'id_serv'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_serv' => 'Id Serv',
			'cod_serv' => 'Cod Serv',
			'nombre_serv' => 'Nombre Serv',
			'unidad_medida' => 'Unidad Medida',
			'tipo_cobro' => 'Tipo Cobro',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_edicion' => 'Fecha Edicion',
			'activo' => 'Activo',
			'id_entidad' => 'Id Entidad',
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

		$criteria->compare('id_serv',$this->id_serv);
		$criteria->compare('cod_serv',$this->cod_serv,true);
		$criteria->compare('nombre_serv',$this->nombre_serv,true);
		$criteria->compare('unidad_medida',$this->unidad_medida,true);
		$criteria->compare('tipo_cobro',$this->tipo_cobro);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_edicion',$this->fecha_edicion,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('id_entidad', $this->id_entidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Servicio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
