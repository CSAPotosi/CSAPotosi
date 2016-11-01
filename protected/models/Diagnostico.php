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
 * @property integer $tipo
 * @property integer $id_historial
 *
 * The followings are the available model relations:
 * @property HistorialMedico $idHistorial
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
			array('anamnesis, id_historial', 'required'),
			array('tipo, id_historial', 'numerical', 'integerOnly'=>true),
			array('exploracion, conclusion, observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_diag, fecha_diag, anamnesis, exploracion, conclusion, observaciones, tipo, id_historial', 'safe', 'on'=>'search'),
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
			'historial' => array(self::BELONGS_TO, 'HistorialMedico', 'id_historial'),
			'itemCies' => array(self::MANY_MANY, 'ItemCie', 'diagnostico_cie(id_diag, codigo)'),
            'evoluciones' => array(self::HAS_MANY,'Evolucion','id_diag'),
            'tratamientos'=>array(self::HAS_MANY,'Tratamiento','id_diag')
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
			'tipo' => 'Tipo',
			'id_historial' => 'Id Historial',
		);
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

    protected function beforeSave(){
        if ($this->isNewRecord)
            $this->fecha_diag = date("d/m/Y H:i");
        return parent::beforeSave();
    }
}
