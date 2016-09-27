<?php

/**
 * This is the model class for table "persona".
 *
 * The followings are the available columns in table 'persona':
 * @property integer $id_persona
 * @property string $num_doc
 * @property integer $tipo_doc
 * @property string $nombres
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property boolean $genero
 * @property string $fecha_nac
 * @property string $estado_civil
 * @property string $ocupacion
 * @property string $nacionalidad
 * @property string $localidad
 * @property string $domicilio
 * @property string $telefono
 * @property string $email
 * @property string $foto
 *
 * The followings are the available model relations:
 * @property Empleado $empleado
 * @property Paciente $paciente
 * @property Medico $medico
 * @property Pais $nacionalidad0
 * @property Usuario[] $usuarios
 */
class Persona extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'persona';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombres, primer_apellido', 'required'),
			array('tipo_doc', 'numerical', 'integerOnly'=>true),
			array('num_doc, primer_apellido, segundo_apellido, estado_civil, ocupacion, telefono', 'length', 'max'=>32),
			array('nombres, email', 'length', 'max'=>128),
			array('nacionalidad', 'length', 'max'=>4),
			array('localidad, domicilio', 'length', 'max'=>64),
			array('foto', 'length', 'max'=>256),
			array('genero, fecha_nac', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_persona, num_doc, tipo_doc, nombres, primer_apellido, segundo_apellido, genero, fecha_nac, estado_civil, ocupacion, nacionalidad, localidad, domicilio, telefono, email, foto', 'safe', 'on'=>'search'),
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
			'empleado' => array(self::HAS_ONE, 'Empleado', 'id_empleado'),
			'paciente' => array(self::HAS_ONE, 'Paciente', 'id_paciente'),
			'medico' => array(self::HAS_ONE, 'Medico', 'id_medico'),
			'nacionalidad' => array(self::BELONGS_TO, 'Pais', 'nacionalidad'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'id_persona'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_persona' => 'Id Persona',
			'num_doc' => 'Num Doc',
			'tipo_doc' => 'Tipo Doc',
			'nombres' => 'Nombres',
			'primer_apellido' => 'Primer Apellido',
			'segundo_apellido' => 'Segundo Apellido',
			'genero' => 'Genero',
			'fecha_nac' => 'Fecha Nac',
			'estado_civil' => 'Estado Civil',
			'ocupacion' => 'Ocupacion',
			'nacionalidad' => 'Nacionalidad',
			'localidad' => 'Localidad',
			'domicilio' => 'Domicilio',
			'telefono' => 'Telefono',
			'email' => 'Email',
			'foto' => 'Foto',
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

		$criteria->compare('id_persona',$this->id_persona);
		$criteria->compare('num_doc',$this->num_doc,true);
		$criteria->compare('tipo_doc',$this->tipo_doc);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('primer_apellido',$this->primer_apellido,true);
		$criteria->compare('segundo_apellido',$this->segundo_apellido,true);
		$criteria->compare('genero',$this->genero);
		$criteria->compare('fecha_nac',$this->fecha_nac,true);
		$criteria->compare('estado_civil',$this->estado_civil,true);
		$criteria->compare('ocupacion',$this->ocupacion,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('localidad',$this->localidad,true);
		$criteria->compare('domicilio',$this->domicilio,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Persona the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTipoDocumento()
	{
		return array(
			'0' => 'Seleccione',
			'1' => 'Pasaporte',
			'2' => 'Documento Personal',
		);
	}

	public function getGenero()
	{
		return array(
			'0' => 'SELECCIONE',
			'1' => 'MASCULINO',
			'2' => 'FEMENINO',
		);
	}

	public function getEstadoCivil()
	{
		return array(
			'0' => 'SELECCIONE',
			'1' => 'SOLTERO',
			'2' => 'CASADO',
			'3' => 'DIVORCIO',
		);
	}

	public function getNombreCompleto()
	{
		return join(" ", array($this->primer_apellido, $this->segundo_apellido, $this->nombres));
	}
}