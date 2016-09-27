<?php

/**
 * This is the model class for table "paciente".
 *
 * The followings are the available columns in table 'paciente':
 * @property integer $id_paciente
 * @property string $codigo_paciente
 * @property string $grupo_sanguineo
 * @property string $fecha_deceso
 * @property integer $estado_paciente
 * @property string $responsable
 *
 * The followings are the available model relations:
 * @property Persona $persona
 * @property HistorialMedico $historialMedico
 */
class Paciente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_paciente', 'required'),
			array('id_paciente, estado_paciente', 'numerical', 'integerOnly'=>true),
			array('codigo_paciente', 'length', 'max'=>16),
			array('grupo_sanguineo', 'length', 'max'=>8),
			array('responsable', 'length', 'max'=>512),
			array('fecha_deceso', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_paciente, codigo_paciente, grupo_sanguineo, fecha_deceso, estado_paciente, responsable', 'safe', 'on'=>'search'),
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
			'persona' => array(self::BELONGS_TO, 'Persona', 'id_paciente'),
			'historialMedico' => array(self::HAS_ONE, 'HistorialMedico', 'id_historial'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_paciente' => 'Id Paciente',
			'codigo_paciente' => 'Codigo Paciente',
			'grupo_sanguineo' => 'Grupo Sanguineo',
			'fecha_deceso' => 'Fecha Deceso',
			'estado_paciente' => 'Estado Paciente',
			'responsable' => 'Responsable',
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

		$criteria->compare('id_paciente',$this->id_paciente);
		$criteria->compare('codigo_paciente',$this->codigo_paciente,true);
		$criteria->compare('grupo_sanguineo',$this->grupo_sanguineo,true);
		$criteria->compare('fecha_deceso',$this->fecha_deceso,true);
		$criteria->compare('estado_paciente',$this->estado_paciente);
		$criteria->compare('responsable',$this->responsable,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paciente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getPatientList($page=0,$query='',$status=1){
		//status: 1=todos, 2=internado, 3=inactivos
		$symbol='=';
		if($status==1)
			$symbol='>=';
		return Paciente::model()->with('persona')->
			findAll([
				'condition'=>"estado_paciente {$symbol} :status
							AND	(codigo_paciente like :query 
								OR concat_ws(' ',persona.primer_apellido,persona.segundo_apellido,persona.nombres) like :query
								OR num_doc like :query)",
				'offset'=>$page,
				'limit'=>Yii::app()->params['itemListLimit'],
				'params'=>[':query'=>'%'.$query.'%', ':status'=>$status]
			]);
	}

	public function getGrupoSanguineo()
	{
		return array(
			'0' => 'ELIJA TIPO DE SANGRE',
			'1' => 'O+',
			'2' => 'A+',
			'3' => 'A-',
			'4' => 'B+',
			'5' => 'B-',
			'6' => 'AB+',
			'7' => 'AB-',
			'8' => 'O-',
		);
	}
}