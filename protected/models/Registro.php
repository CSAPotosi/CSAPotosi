<?php

/**
 * This is the model class for table "registro".
 *
 * The followings are the available columns in table 'registro':
 * @property integer $id_asignacion
 * @property string $fecha
 * @property string $hora_asistencia
 * @property string $observaciones
 * @property boolean $estado
 *
 * The followings are the available model relations:
 * @property AsignacionEmpleado $idAsignacion
 */
class Registro extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'registro';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_asignacion, fecha, hora_asistencia', 'required'),
            array('id_asignacion', 'numerical', 'integerOnly' => true),
            array('observaciones', 'length', 'max' => 128),
            array('estado', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_asignacion, fecha, hora_asistencia, observaciones, estado', 'safe', 'on' => 'search'),
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
            'idAsignacion' => array(self::BELONGS_TO, 'AsignacionEmpleado', 'id_asignacion'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_asignacion' => 'Id Asignacion',
            'fecha' => 'Fecha',
            'hora_asistencia' => 'Hora Asistencia',
            'observaciones' => 'Observaciones',
            'estado' => 'Estado',
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

        $criteria->compare('id_asignacion', $this->id_asignacion);
        $criteria->compare('fecha', $this->fecha, true);
        $criteria->compare('hora_asistencia', $this->hora_asistencia, true);
        $criteria->compare('observaciones', $this->observaciones, true);
        $criteria->compare('estado', $this->estado);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Registro the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
