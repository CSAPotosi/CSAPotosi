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
            array('id_sala','checkAvailability'),
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
            'fec_reserva' => 'FECHA Y HORA DE RESERVA',
            'fec_inicio' => 'FECHA Y HORA DE INICIO',
            'fec_fin' => 'FECHA Y HORA DE FIN',
            'tiempo_estimado' => 'TIEMPO ESTIMADO (MIN.)',
            'tiempo_real' => 'Tiempo Real',
            'naturaleza' => 'NATURALEZA',
            'id_historial' => 'PACIENTE',
            'id_sala' => 'QUIROFANO',
            'detalle_instrumental'=>'DETALLE DE INSTRUMENTAL UTILIZADO'
        );
    }

	public function checkAvailability($attribute, $params){
        $this->addError($attribute,'La sala no existe.');
    }

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
