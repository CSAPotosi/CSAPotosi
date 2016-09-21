<?php

/**
 * This is the model class for table "diagnostico".
 *
 * The followings are the available columns in table 'diagnostico':
 * @property integer $id_diag
 * @property string $fecha_diag
 * @property string $anamnesis
 * @property string $exploracion
 * @property string $conclusion
 * @property string $observaciones
 * @property integer $id_historial
 * @property integer $id_diag_padre
 *
 * The followings are the available model relations:
 * @property HistorialMedico $idHistorial
 * @property Diagnostico $idDiagPadre
 * @property Diagnostico[] $diagnosticos
 * @property ItemCie[] $itemCies
 */
class Diagnostico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'diagnostico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_diag, id_historial', 'required'),
			array('id_historial, id_diag_padre', 'numerical', 'integerOnly'=>true),
			array('anamnesis, exploracion, conclusion, observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_diag, fecha_diag, anamnesis, exploracion, conclusion, observaciones, id_historial, id_diag_padre', 'safe', 'on'=>'search'),
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
			'idHistorial' => array(self::BELONGS_TO, 'HistorialMedico', 'id_historial'),
			'idDiagPadre' => array(self::BELONGS_TO, 'Diagnostico', 'id_diag_padre'),
			'diagnosticos' => array(self::HAS_MANY, 'Diagnostico', 'id_diag_padre'),
			'itemCies' => array(self::MANY_MANY, 'ItemCie', 'diagnostico_cie(id_diag, codigo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_diag' => 'Id Diag',
			'fecha_diag' => 'Fecha Diag',
			'anamnesis' => 'Anamnesis',
			'exploracion' => 'Exploracion',
			'conclusion' => 'Conclusion',
			'observaciones' => 'Observaciones',
			'id_historial' => 'Id Historial',
			'id_diag_padre' => 'Id Diag Padre',
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

		$criteria->compare('id_diag',$this->id_diag);
		$criteria->compare('fecha_diag',$this->fecha_diag,true);
		$criteria->compare('anamnesis',$this->anamnesis,true);
		$criteria->compare('exploracion',$this->exploracion,true);
		$criteria->compare('conclusion',$this->conclusion,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('id_historial',$this->id_historial);
		$criteria->compare('id_diag_padre',$this->id_diag_padre);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Diagnostico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
