<?php

/**
 * This is the model class for table "cita".
 *
 * The followings are the available columns in table 'cita':
 * @property integer $id_cita
 * @property string $fecha
 * @property string $hora_cita
 * @property integer $estado_cita
 * @property integer $id_paciente
 * @property integer $medico_consulta_servicio
 *
 * The followings are the available model relations:
 * @property Paciente $idPaciente
 * @property MedicoEspecialidad $medicoConsultaServicio
 */
class Cita extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'cita';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fecha, hora_cita,id_paciente,medico_consulta_servicio', 'required'),
            array('estado_cita, id_paciente, medico_consulta_servicio', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_cita, fecha, hora_cita, estado_cita, id_paciente, medico_consulta_servicio', 'safe', 'on' => 'search'),
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
            'paciente' => array(self::BELONGS_TO, 'Paciente', 'id_paciente'),
            'medicoConsultaServicio' => array(self::BELONGS_TO, 'MedicoEspecialidad', 'medico_consulta_servicio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_cita' => 'Id Cita',
            'fecha' => 'Fecha',
            'hora_cita' => 'Hora Cita',
            'estado_cita' => 'Estado Cita',
            'id_paciente' => 'Paciente',
            'medico_consulta_servicio' => 'Especialidad',
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

        $criteria->compare('id_cita', $this->id_cita);
        $criteria->compare('fecha', $this->fecha, true);
        $criteria->compare('hora_cita', $this->hora_cita, true);
        $criteria->compare('estado_cita', $this->estado_cita);
        $criteria->compare('id_paciente', $this->id_paciente);
        $criteria->compare('medico_consulta_servicio', $this->medico_consulta_servicio);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Cita the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
