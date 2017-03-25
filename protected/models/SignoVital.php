<?php

/**
 * This is the model class for table "signo_vital".
 *
 * The followings are the available columns in table 'signo_vital':
 * @property integer $id_sv
 * @property string $fecha_sv
 * @property string $valor_sv
 * @property integer $id_par
 * @property integer $id_historial
 *
 * The followings are the available model relations:
 * @property HistorialMedico $idHistorial
 * @property Parametro $idPar
 */
class SignoVital extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'signo_vital';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_par, id_historial', 'required'),
            array('valor_sv','jsonRule'),
			array('id_par, id_historial', 'numerical', 'integerOnly'=>true),
			array('valor_sv', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sv, fecha_sv, valor_sv, id_par, id_historial', 'safe', 'on'=>'search'),
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
			'parametro' => array(self::BELONGS_TO, 'Parametro', 'id_par'),
            'usuario'=>array(self::BELONGS_TO,'Usuario','id_usuario')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sv' => 'Id Sv',
			'fecha_sv' => 'Fecha Sv',
			'valor_sv' => 'Valor Sv',
			'id_par' => 'Id Par',
			'id_historial' => 'Id Historial',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SignoVital the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        $this->fecha_sv = date('d/m/Y H:i:s');
        $this->id_usuario = Yii::app()->user->isGuest?0:Yii::app()->user->id;
        return parent::beforeSave();
    }

    public function jsonRule($attribute, $params){
        $json_def = json_decode($this->parametro->def_par);
        if($this->$attribute != ''){
            if($json_def->type == 'numeric'){
                if(is_numeric($this->$attribute)){
                    if (isset($json_def->range)){
                        if(!($this->$attribute>=$json_def->range->min && $this->$attribute<=$json_def->range->max))
                            $this->addError($attribute,"Valor fuera de rango ({$json_def->range->min} - {$json_def->range->max})");
                    }
                }else{
                    $this->addError($attribute,'El valor debe ser numerico.');
                }
            }
        }
    }
}
