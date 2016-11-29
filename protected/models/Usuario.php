<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id_usuario
 * @property string $nombre_usuario
 * @property string $clave
 * @property boolean $estado_usuario
 *
 * The followings are the available model relations:
 * @property Persona $idUsuario
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $claveCompare;
	public $claveAnterior;

	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, nombre_usuario, clave, claveCompare', 'required'),
			array('id_usuario', 'numerical', 'integerOnly' => true),
			array('nombre_usuario', 'length', 'max' => 32),
			array('clave, claveCompare', 'length', 'min' => 6),
			array('clave', 'compare', 'compareAttribute' => 'claveCompare'),
			array('estado_usuario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, nombre_usuario, clave, estado_usuario, claveCompare', 'safe', 'on' => 'search'),
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
			'persona' => array(self::BELONGS_TO, 'Persona', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'PERSONA',
			'nombre_usuario' => 'NOMBRE DE USUARIO',
			'clave' => 'CONTRASEÑA',
			'claveCompare' => 'REPITA LA CONTRASEÑA',
			'estado_usuario' => 'ACTIVO',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id_usuario', $this->id_usuario);
		$criteria->compare('nombre_usuario', $this->nombre_usuario, true);
		$criteria->compare('clave', $this->clave, true);
		$criteria->compare('estado_usuario', $this->estado_usuario);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	public static function getUsuarioList($page = 0, $query = '', $status = 'all')
	{
		//status: 1=todos, 2=activos, 3=inactivos
		if ($status != 'all') {
			return Usuario::model()->with('persona')->
			findAll([
				'condition' => "estado_usuario = :status
							AND	(nombre_usuario like :query 
								OR concat_ws(' ',persona.primer_apellido,persona.segundo_apellido,persona.nombres) like :query)",
				'offset' => $page,
				'limit' => Yii::app()->params['itemListLimit'],
				'params' => [':query' => '%' . $query . '%', ':status' => $status]
			]);
		}
		return Usuario::model()->with('persona')->
		findAll([
			'condition' => "nombre_usuario like :query 
								OR concat_ws(' ',persona.primer_apellido,persona.segundo_apellido,persona.nombres) like :query",
			'offset' => $page,
			'limit' => Yii::app()->params['itemListLimit'],
			'params' => [':query' => '%' . $query . '%']
		]);
	}
}
