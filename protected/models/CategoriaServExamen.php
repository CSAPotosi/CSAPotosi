<?php

/**
 * This is the model class for table "categoria_serv_examen".
 *
 * The followings are the available columns in table 'categoria_serv_examen':
 * @property integer $id_cat_ex
 * @property string $cod_cat_ex
 * @property string $nombre_cat_ex
 * @property string $descripcion_cat_ex
 * @property boolean $activo
 * @property integer $tipo_ex
 *
 * The followings are the available model relations:
 * @property ServExamen[] $servExamens
 */
class CategoriaServExamen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categoria_serv_examen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_cat_ex, nombre_cat_ex', 'required'),
			array('tipo_ex', 'numerical', 'integerOnly'=>true),
			array('cod_cat_ex', 'length', 'max'=>8),
			array('nombre_cat_ex', 'length', 'max'=>64),
			array('descripcion_cat_ex, activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cat_ex, cod_cat_ex, nombre_cat_ex, descripcion_cat_ex, activo, tipo_ex', 'safe', 'on'=>'search'),
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
			'examenes' => array(self::HAS_MANY, 'ServExamen', 'id_cat_ex'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cat_ex' => 'Id Cat Ex',
			'cod_cat_ex' => 'Cod Cat Ex',
			'nombre_cat_ex' => 'Nombre Cat Ex',
			'descripcion_cat_ex' => 'Descripcion Cat Ex',
			'activo' => 'Activo',
			'tipo_ex' => 'Tipo Ex',
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

		$criteria->compare('id_cat_ex',$this->id_cat_ex);
		$criteria->compare('cod_cat_ex',$this->cod_cat_ex,true);
		$criteria->compare('nombre_cat_ex',$this->nombre_cat_ex,true);
		$criteria->compare('descripcion_cat_ex',$this->descripcion_cat_ex,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('tipo_ex',$this->tipo_ex);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoriaServExamen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTipoEx()
	{
		$atributo[] = "";
		$valor = CategoriaServicioExamen::model()->findAll();
		$var = '';
		foreach ($valor as $item):
			if ($var != $item['tipo_ex']) {
				$atributo[] = $item['tipo_ex'];
				$var = $item['tipo_ex'];
			} else {
				$var = $item['tipo_ex'];
			}
		endforeach;
		return $atributo;
	}

	public function getNombreTipo()
	{
		return $nombres = [0 => 'TODO', 1 => 'EXAMENES DE LABORATORIO', 2 => 'EXAMENES DE RAYOS X'];
	}
}
