<?php

/**
 * This is the model class for table "prestacion_servicio".
 *
 * The followings are the available columns in table 'prestacion_servicio':
 * @property integer $id_prestacion
 * @property integer $id_historial
 * @property string $observaciones
 * @property integer $tipo
 * @property string $fecha_solicitud
 *
 * The followings are the available model relations:
 * @property HistorialMedico $historial
 * @property DetallePrestacion[] $detallePrestacions
 */
class PrestacionServicio extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'prestacion_servicio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_historial, tipo', 'required'),
            array('id_historial, tipo', 'numerical', 'integerOnly' => true),
            array('observaciones', 'length', 'max' => 256),
            array('fecha_solicitud', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_prestacion, id_historial, observaciones, tipo, fecha_solicitud', 'safe', 'on' => 'search'),
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
            'detallePrestacions' => array(self::HAS_MANY, 'DetallePrestacion', 'id_prestacion'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_prestacion' => 'Id Prestacion',
            'id_historial' => 'Id Historial',
            'observaciones' => 'Observaciones',
            'tipo' => 'Tipo',
            'fecha_solicitud' => 'Fecha Solicitud',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id_prestacion', $this->id_prestacion);
        $criteria->compare('id_historial', $this->id_historial);
        $criteria->compare('observaciones', $this->observaciones, true);
        $criteria->compare('tipo', $this->tipo);
        $criteria->compare('fecha_solicitud', $this->fecha_solicitud, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PrestacionServicio the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
