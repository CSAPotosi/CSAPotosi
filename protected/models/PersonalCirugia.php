<?php

/**
 * This is the model class for table "personal_cirugia".
 *
 * The followings are the available columns in table 'personal_cirugia':
 * @property integer $id_cir
 * @property integer $id_per
 * @property boolean $responsable
 * @property string $rol_cirugia
 *
 * The followings are the available model relations:
 * @property Cirugia $idCir
 * @property Persona $idPer
 */
class PersonalCirugia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal_cirugia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_per', 'required'),
			array('id_cir, id_per', 'numerical', 'integerOnly'=>true),
			array('rol_cirugia', 'length', 'max'=>36),
			array('responsable', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cir, id_per, responsable, rol_cirugia', 'safe', 'on'=>'search'),
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
			'cirugia' => array(self::BELONGS_TO, 'Cirugia', 'id_cir'),
			'persona' => array(self::BELONGS_TO, 'Persona', 'id_per'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cir' => 'Id Cir',
			'id_per' => 'MEDICO/ENFERMERA',
			'responsable' => 'RESPONSABLE',
			'rol_cirugia' => 'ROL',
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

		$criteria->compare('id_cir',$this->id_cir);
		$criteria->compare('id_per',$this->id_per);
		$criteria->compare('responsable',$this->responsable);
		$criteria->compare('rol_cirugia',$this->rol_cirugia,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PersonalCirugia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getRolPersonal(){
        return [
            'CIRUJANO' => 'CIRUJANO',
            'ANESTESIOLOGO' => 'ANESTESIOLOGO',
            'AUXILIAR 1' => 'AUXILIAR 1',
            'AUXILIAR 2' => 'AUXILIAR 2',
            'INSTRUMENTISTA' => 'INSTRUMENTISTA'
        ];
    }
}
