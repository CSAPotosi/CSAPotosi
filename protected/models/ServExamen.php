<?php

/**
 * This is the model class for table "serv_examen".
 *
 * The followings are the available columns in table 'serv_examen':
 * @property integer $id_serv
 * @property string $condiciones_ex
 * @property integer $id_cat_ex
 *
 * The followings are the available model relations:
 * @property Servicio $idServ
 * @property CategoriaServExamen $idCatEx
 * @property ExamenParametro $examenParametros
 */
class ServExamen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'serv_examen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_ex', 'required'),
			array('id_serv, id_cat_ex', 'numerical', 'integerOnly'=>true),
			array('condiciones_ex', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_serv, condiciones_ex, id_cat_ex', 'safe', 'on'=>'search'),
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
			'datosServicio' => array(self::BELONGS_TO, 'Servicio', 'id_serv'),
			'categoria' => array(self::BELONGS_TO, 'CategoriaServExamen', 'id_cat_ex'),
            'examenParametros'=>array(self::HAS_MANY,'ExamenParametro','id_serv','order'=>'orden ASC')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_serv' => 'Id Serv',
			'condiciones_ex' => 'Condiciones Ex',
			'id_cat_ex' => 'Id Cat Ex',
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
		$criteria->compare('condiciones_ex',$this->condiciones_ex,true);
		$criteria->compare('id_cat_ex',$this->id_cat_ex);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServExamen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
