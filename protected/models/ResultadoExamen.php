<?php

/**
 * This is the model class for table "resultado_examen".
 *
 * The followings are the available columns in table 'resultado_examen':
 * @property integer $id_res
 * @property string $diagnostico_res
 * @property string $observacion_res
 * @property string $fec_res
 * @property integer $id_det_pres
 *
 * The followings are the available model relations:
 * @property DetallePrestacion $idDetPres
 * @property Parametro[] $parametros
 */
class ResultadoExamen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resultado_examen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('diagnostico_res, id_det_pres', 'required'),
			array('id_det_pres', 'numerical', 'integerOnly'=>true),
			array('observacion_res', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_res, diagnostico_res, observacion_res, fec_res, id_det_pres', 'safe', 'on'=>'search'),
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
			'detallePrestacion' => array(self::BELONGS_TO, 'DetallePrestacion', 'id_det_pres'),
            'detalleResultados'=>array(self::HAS_MANY,'DetalleResultado','id_res'),
			'parametros' => array(self::MANY_MANY, 'Parametro', 'detalle_resultado(id_res, id_par)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_res' => 'Id Res',
			'diagnostico_res' => 'DIAGNOSTICO DE EXAMEN',
			'observacion_res' => 'OBSERVACIONES',
			'fec_res' => 'Fec Res',
			'id_det_pres' => 'Id Det Pres',
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
		$criteria->compare('diagnostico_res',$this->diagnostico_res,true);
		$criteria->compare('observacion_res',$this->observacion_res,true);
		$criteria->compare('fec_res',$this->fec_res,true);
		$criteria->compare('id_det_pres',$this->id_det_pres);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResultadoExamen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->fec_res = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
    }

}
