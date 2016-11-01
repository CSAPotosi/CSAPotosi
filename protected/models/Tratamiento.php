<?php

/**
 * This is the model class for table "tratamiento".
 *
 * The followings are the available columns in table 'tratamiento':
 * @property integer $id_trat
 * @property string $fecha_trat
 * @property string $instrucciones
 * @property string $observaciones
 * @property integer $id_diag
 *
 * The followings are the available model relations:
 * @property Diagnostico $idDiag
 * @property Medicamento[] $medicamentos
 */
class Tratamiento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tratamiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('instrucciones, id_diag', 'required'),
			array('id_diag', 'numerical', 'integerOnly'=>true),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_trat, fecha_trat, instrucciones, observaciones, id_diag', 'safe', 'on'=>'search'),
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
			'diagnostico' => array(self::BELONGS_TO, 'Diagnostico', 'id_diag'),
			'recetas' => array(self::HAS_MANY, 'Receta', 'id_trat'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_trat' => 'Id Trat',
			'fecha_trat' => 'Fecha Trat',
			'instrucciones' => 'Instrucciones',
			'observaciones' => 'Observaciones',
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

		$criteria->compare('id_trat',$this->id_trat);
		$criteria->compare('fecha_trat',$this->fecha_trat,true);
		$criteria->compare('instrucciones',$this->instrucciones,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('id_diag',$this->id_diag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tratamiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->fecha_trat = date('d/m/Y H:i');
        }
        return parent::beforeSave();
    }
}
