<?php

/**
 * This is the model class for table "evolucion".
 *
 * The followings are the available columns in table 'evolucion':
 * @property integer $id_evo
 * @property string $fecha_evo
 * @property string $exploracion_evo
 * @property string $estado_paciente
 * @property string $recomendaciones
 * @property integer $id_diag
 *
 * The followings are the available model relations:
 * @property Diagnostico $idDiag
 */
class Evolucion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'evolucion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado_paciente, id_diag', 'required'),
			array('id_diag', 'numerical', 'integerOnly'=>true),
			array('exploracion_evo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_evo, fecha_evo, exploracion_evo, estado_paciente, id_diag', 'safe', 'on'=>'search'),
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
			'idDiag' => array(self::BELONGS_TO, 'Diagnostico', 'id_diag'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_evo' => 'Id Evo',
			'fecha_evo' => 'Fecha Evo',
			'exploracion_evo' => 'Exploracion Evo',
			'estado_paciente' => 'Estado Paciente',
			'id_diag' => 'Id Diag',
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

		$criteria->compare('id_evo',$this->id_evo);
		$criteria->compare('fecha_evo',$this->fecha_evo,true);
		$criteria->compare('exploracion_evo',$this->exploracion_evo,true);
		$criteria->compare('estado_paciente',$this->estado_paciente,true);
		$criteria->compare('id_diag',$this->id_diag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evolucion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if($this->isNewRecord){
            $this->fecha_evo = date('d/m/Y H:i');
        }
        return parent::beforeSave();
    }
}
