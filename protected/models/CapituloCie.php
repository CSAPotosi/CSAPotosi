<?php

/**
 * This is the model class for table "capitulo_cie".
 *
 * The followings are the available columns in table 'capitulo_cie':
 * @property string $num_cap
 * @property string $titulo_cap
 *
 * The followings are the available model relations:
 * @property CategoriaCie[] $categoriaCies
 */
class CapituloCie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'capitulo_cie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('num_cap, titulo_cap', 'required'),
			array('num_cap', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('num_cap, titulo_cap', 'safe', 'on'=>'search'),
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
			'categoriaCies' => array(self::HAS_MANY, 'CategoriaCie', 'num_cap'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'num_cap' => 'Num Cap',
			'titulo_cap' => 'Titulo Cap',
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

		$criteria->compare('num_cap',$this->num_cap,true);
		$criteria->compare('titulo_cap',$this->titulo_cap,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CapituloCie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
