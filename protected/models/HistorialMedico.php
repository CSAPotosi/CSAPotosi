<?php

/**
 * This is the model class for table "historial_medico".
 *
 * The followings are the available columns in table 'historial_medico':
 * @property integer $id_historial
 * @property string $fecha_creacion
 * @property string $fecha_edicion
 *
 * The followings are the available model relations:
 * @property Paciente $idHistorial
 */
class HistorialMedico extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'historial_medico';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_historial, fecha_creacion, fecha_edicion', 'required'),
            array('id_historial', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_historial, fecha_creacion, fecha_edicion', 'safe', 'on' => 'search'),
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
            'paciente' => array(self::BELONGS_TO, 'Paciente', 'id_historial'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_historial' => 'Id Historial',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_edicion' => 'Fecha Edicion',
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

        $criteria->compare('id_historial', $this->id_historial);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('fecha_edicion', $this->fecha_edicion, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return HistorialMedico the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeValidate()
    {
        $this->fecha_edicion = date('d/m/Y h:i:s A');
        if ($this->IsNewRecord)
            $this->fecha_creacion = date('d/m/Y h:i:s A');
        return parent::beforeValidate();
    }
}
