<?php

/**
 * This is the model class for table "detalle_resultado".
 *
 * The followings are the available columns in table 'detalle_resultado':
 * @property integer $id_res
 * @property integer $id_par
 * @property string $valor_res
 */
class DetalleResultado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_resultado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_par, valor_res', 'required'),
			array('id_res, id_par', 'numerical', 'integerOnly'=>true),
			array('valor_res', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_res, id_par, valor_res', 'safe', 'on'=>'search'),
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
            'parametro' => array(self::BELONGS_TO, 'Parametro', 'id_par'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_res' => 'Id Res',
			'id_par' => 'Id Par',
			'valor_res' => 'Valor Res',
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

		$criteria->compare('id_res',$this->id_res);
		$criteria->compare('id_par',$this->id_par);
		$criteria->compare('valor_res',$this->valor_res,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleResultado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
