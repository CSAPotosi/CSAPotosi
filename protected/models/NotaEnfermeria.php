<?php

/**
 * This is the model class for table "nota_enfermeria".
 *
 * The followings are the available columns in table 'nota_enfermeria':
 * @property integer $id_n_enf
 * @property string $fecha_n_enf
 * @property string $estado_salud
 * @property string $dieta_indicada
 * @property string $dieta_aceptada
 * @property string $evacuaciones
 * @property string $uresis
 * @property string $vomito
 * @property string $ind_medico
 * @property integer $id_inter
 *
 * The followings are the available model relations:
 * @property Internacion $idInter
 */
class NotaEnfermeria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nota_enfermeria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado_salud, id_inter', 'required'),
			array('id_inter', 'numerical', 'integerOnly'=>true),
			array('estado_salud', 'length', 'max'=>64),
			array('dieta_indicada, dieta_aceptada, evacuaciones, uresis, vomito, ind_medico', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_n_enf, fecha_n_enf, estado_salud, dieta_indicada, dieta_aceptada, evacuaciones, uresis, vomito, ind_medico, id_inter', 'safe', 'on'=>'search'),
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
			'internacion' => array(self::BELONGS_TO, 'Internacion', 'id_inter'),
            'usuario'=> array(self::BELONGS_TO,'Usuario','id_usuario')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_n_enf' => 'Id N Enf',
			'fecha_n_enf' => 'Fecha N Enf',
			'estado_salud' => 'Estado Salud',
			'dieta_indicada' => 'Dieta Indicada',
			'dieta_aceptada' => 'Dieta Aceptada',
			'evacuaciones' => 'Evacuaciones',
			'uresis' => 'Uresis',
			'vomito' => 'Vomito',
			'ind_medico' => 'Ind Medico',
			'id_inter' => 'Id Inter',
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotaEnfermeria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        $this->fecha_n_enf = date('d/m/Y H:i');
        $this->id_usuario = Yii::app()->user->isGuest?0:Yii::app()->user->id;
        return parent::beforeSave();
    }
}
