<?php

/**
 * This is the model class for table "empleado".
 *
 * The followings are the available columns in table 'empleado':
 * @property integer $id_empleado
 * @property string $fecha_contratacion
 * @property boolean $estado_emp
 * @property integer $cod_maquina
 *
 * The followings are the available model relations:
 * @property Persona $idEmpleado
 */
class Empleado extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'empleado';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_empleado', 'required'),
            array('id_empleado, cod_maquina', 'numerical', 'integerOnly' => true),
            array('fecha_contratacion, estado_emp', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_empleado, fecha_contratacion, estado_emp, cod_maquina', 'safe', 'on' => 'search'),
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
            'empleadoPersona' => array(self::BELONGS_TO, 'Persona', 'id_empleado'),
            'asignacion' => array(self::HAS_MANY, 'AsignacionEmpleado', 'id_empleado'),
            'asignacionValida' => array(self::HAS_MANY, 'AsignacionEmpleado', 'id_empleado', 'condition' => 'fecha_fin is null')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_empleado' => 'Id Empleado',
            'fecha_contratacion' => 'Fecha Contratacion',
            'estado_emp' => 'Estado Emp',
            'cod_maquina' => 'Cod Maquina',
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

        $criteria->compare('id_empleado', $this->id_empleado);
        $criteria->compare('fecha_contratacion', $this->fecha_contratacion, true);
        $criteria->compare('estado_emp', $this->estado_emp);
        $criteria->compare('cod_maquina', $this->cod_maquina);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Empleado the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
