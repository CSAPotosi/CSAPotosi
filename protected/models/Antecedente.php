<?php

/**
 * This is the model class for table "antecedente".
 *
 * The followings are the available columns in table 'antecedente':
 * @property integer $id_ant
 * @property string $fecha_ant
 * @property string $valor_ant
 * @property integer $id_par
 * @property integer $id_historial
 *
 * The followings are the available model relations:
 * @property HistorialMedico $idHistorial
 * @property Parametro $idPar
 */
class Antecedente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'antecedente';
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
            array('valor_ant','jsonRule'),
			array('id_par, id_historial', 'numerical', 'integerOnly'=>true),
			array('valor_ant', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ant, fecha_ant, valor_ant, id_par, id_historial', 'safe', 'on'=>'search'),
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
			'id_ant' => 'Id Ant',
			'fecha_ant' => 'Fecha Ant',
			'valor_ant' => 'Valor Ant',
			'id_par' => 'Id Par',
			'id_historial' => 'Id Historial',
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

		$criteria->compare('id_ant',$this->id_ant);
		$criteria->compare('fecha_ant',$this->fecha_ant,true);
		$criteria->compare('valor_ant',$this->valor_ant,true);
		$criteria->compare('id_par',$this->id_par);
		$criteria->compare('id_historial',$this->id_historial);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Antecedente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        $this->fecha_ant = date('Y-m-d H:i:s');
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
