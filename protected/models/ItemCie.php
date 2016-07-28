<?php

/**
 * This is the model class for table "item_cie".
 *
 * The followings are the available columns in table 'item_cie':
 * @property string $codigo
 * @property string $titulo
 * @property string $descripcion
 * @property string $codigo_padre
 * @property integer $id_cat
 *
 * The followings are the available model relations:
 * @property ItemCie $codigoPadre
 * @property ItemCie[] $itemCies
 * @property CategoriaCie $idCat
 */
class ItemCie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_cie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, titulo, id_cat', 'required'),
			array('id_cat', 'numerical', 'integerOnly'=>true),
			array('codigo, codigo_padre', 'length', 'max'=>8),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, titulo, descripcion, codigo_padre, id_cat', 'safe', 'on'=>'search'),
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
			'codigoPadre' => array(self::BELONGS_TO, 'ItemCie', 'codigo_padre'),
			'itemCies' => array(self::HAS_MANY, 'ItemCie', 'codigo_padre'),
			'idCat' => array(self::BELONGS_TO, 'CategoriaCie', 'id_cat'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'codigo_padre' => 'Codigo Padre',
			'id_cat' => 'Id Cat',
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

		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('codigo_padre',$this->codigo_padre,true);
		$criteria->compare('id_cat',$this->id_cat);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemCie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
