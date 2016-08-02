<?php

/**
 * This is the model class for table "asignacion_empleado".
 *
 * The followings are the available columns in table 'asignacion_empleado':
 * @property integer $id_asignacion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property boolean $vigencia
 * @property integer $id_empleado
 * @property integer $id_cargo
 *
 * The followings are the available model relations:
 * @property Empleado $idEmpleado
 * @property Cargo $idCargo
 */
class AsignacionEmpleado extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'asignacion_empleado';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fecha_inicio', 'required'),
            array('id_empleado, id_cargo', 'numerical', 'integerOnly' => true),
            array('fecha_fin, vigencia', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_asignacion, fecha_inicio, fecha_fin, vigencia, id_empleado, id_cargo', 'safe', 'on' => 'search'),
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
            'idEmpleado' => array(self::BELONGS_TO, 'Empleado', 'id_empleado'),
            'idCargo' => array(self::BELONGS_TO, 'Cargo', 'id_cargo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_asignacion' => 'Id Asignacion',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'vigencia' => 'Vigencia',
            'id_empleado' => 'Id Empleado',
            'id_cargo' => 'Id Cargo',
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
        $criteria->compare('fecha_inicio', $this->fecha_inicio, true);
        $criteria->compare('fecha_fin', $this->fecha_fin, true);
        $criteria->compare('vigencia', $this->vigencia);
        $criteria->compare('id_empleado', $this->id_empleado);
        $criteria->compare('id_cargo', $this->id_cargo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AsignacionEmpleado the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getEmpleado()
    {
        return Empleado::model()->findAll("id_empleado not in(select id_empleado from asignacion_empleado where fecha_fin is null)");
    }

    public function getCargo()
    {
        return CHtml::listData(Cargo::model()->findAll("id_cargo not in (select id_cargo from asignacion_empleado where fecha_fin is null)"), 'id_cargo', 'nombre_cargo');
    }
}
