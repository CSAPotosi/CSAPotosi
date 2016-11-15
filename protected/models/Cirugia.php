<?php

/**
 * This is the model class for table "cirugia".
 *
 * The followings are the available columns in table 'cirugia':
 * @property integer $id_cir
 * @property string $fec_reserva
 * @property string $fec_inicio
 * @property string $fec_fin
 * @property integer $tiempo_estimado
 * @property integer $tiempo_real
 * @property string $naturaleza
 * @property string $detalle_instrumental
 * @property boolean $reservado
 * @property integer $id_historial
 * @property integer $id_sala
 *
 * The followings are the available model relations:
 * @property HistorialMedico $idHistorial
 * @property Sala $idSala
 * @property PersonalCirugia[] $personalCirugias
 */
class Cirugia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cirugia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_historial, id_sala', 'required'),
            array('fec_reserva, tiempo_estimado', 'required', 'on'=>'reserva'),
            array('fec_inicio, fec_fin','required','on'=>'registro'),
			array('tiempo_estimado, tiempo_real, id_historial, id_sala', 'numerical', 'integerOnly'=>true),
			array('fec_reserva, fec_inicio, fec_fin, naturaleza,detalle_instrumental , reservado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cir, fec_reserva, fec_inicio, fec_fin, tiempo_estimado, tiempo_real, naturaleza, reservado, id_historial, id_sala', 'safe', 'on'=>'search'),
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
            'sala' => array(self::BELONGS_TO, 'Sala', 'id_sala'),
            'personalCirugias' => array(self::HAS_MANY, 'PersonalCirugia', 'id_cir'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_cir' => 'Id Cir',
            'fec_reserva' => 'Fecha y hora de reserva',
            'fec_inicio' => 'Fec Inicio',
            'fec_fin' => 'Fec Fin',
            'tiempo_estimado' => 'Tiempo Estimado (min)',
            'tiempo_real' => 'Tiempo Real',
            'naturaleza' => 'Naturaleza',
            'id_historial' => 'Paciente',
            'id_sala' => 'Quirofano',
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

		$criteria->compare('id_cir',$this->id_cir);
		$criteria->compare('fec_reserva',$this->fec_reserva,true);
		$criteria->compare('fec_inicio',$this->fec_inicio,true);
		$criteria->compare('fec_fin',$this->fec_fin,true);
		$criteria->compare('tiempo_estimado',$this->tiempo_estimado);
		$criteria->compare('tiempo_real',$this->tiempo_real);
		$criteria->compare('naturaleza',$this->naturaleza,true);
		$criteria->compare('reservado',$this->reservado);
		$criteria->compare('id_historial',$this->id_historial);
		$criteria->compare('id_sala',$this->id_sala);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cirugia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
