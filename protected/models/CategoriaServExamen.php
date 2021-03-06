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
	public $max_code = '';
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
			array('nombre_cat_ex', 'required'),
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
		$valor = CategoriaServExamen::model()->findAll(['condition' => "tipo_ex>=0 order by tipo_ex"]);
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
		return $nombres = [0 => 'TODO', 1 => 'EXAMENES DE LABORATORIO', 2 => 'EXAMENES DE RAYOS X', 3 => 'SERVICIO CLINICO'];
	}

	public function beforeSave()
	{
		if ($this->isNewRecord) {
			$this->cod_cat_ex = $this->getCode();
		}
		return parent::beforeSave();
	}

	private function getCode()
	{
		$prefix = $this->cod_cat_ex;
		$criteria = new CDbCriteria();
		$criteria->select = 'MAX(cod_cat_ex) as max_code';
		$criteria->condition = 'cod_cat_ex like :code';
		$criteria->params = [':code' => "{$prefix}%"];
		$model = $this->find($criteria);
		$code = $model['max_code'];
		$sufix = '';
		if ($code) {
			$sufix = HelpTools::appendToBaseNumber(substr($code, -3), 36, 1);
		} else {
			$sufix = HelpTools::appendToBaseNumber('000', 36, 1);
		}
		$code = $prefix . str_pad($sufix, 3, 'E', STR_PAD_LEFT);
		return $code;
	}
}
