<?php

/**
 * This is the model class for table "parametro".
 *
 * The followings are the available columns in table 'parametro':
 * @property integer $id_par
 * @property string $nombre_par
 * @property string $ext_par
 * @property integer $tipo_par
 * @property string $def_par
 * @property string $val_ref
 * The followings are the available model relations:
 * @property Servicio[] $servicios
 * @property ResultadoExamen[] $resultadoExamens
 */
class Parametro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parametro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_par', 'required'),
			array('tipo_par', 'numerical', 'integerOnly'=>true),
			array('nombre_par', 'length', 'max'=>64),
			array('ext_par', 'length', 'max'=>16),
			array('def_par,val_ref', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_par, nombre_par, ext_par, tipo_par, def_par', 'safe', 'on'=>'search'),
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
			'servicios' => array(self::MANY_MANY, 'Servicio', 'examen_parametro(id_par, id_serv)'),
			'resultadoExamens' => array(self::MANY_MANY, 'ResultadoExamen', 'detalle_resultado(id_par, id_res)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_par' => 'Id Par',
			'nombre_par' => 'NOMBRE',
			'ext_par' => 'UNIDAD',
			'tipo_par' => 'TIPO',
			'def_par' => 'Def Par',
            'val_ref' => 'VALORES DE REFERENCIA'
		);
	}
    

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Parametro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTipo(){
        return [
            0=>'EXAMEN',
            1=>'SIGNOS VITALES',
            2=>'ANTECEDENTES'
        ];
    }
}
