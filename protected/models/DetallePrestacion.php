<?php

/**
 * This is the model class for table "detalle_prestacion".
 *
 * The followings are the available columns in table 'detalle_prestacion':
 * @property integer $id_detalle
 * @property integer $id_prestacion
 * @property integer $id_servicio
 * @property string $fecha_solicitud
 * @property double $cantidad
 * @property double $subtotal
 * @property boolean $pagado
 * @property boolean $realizado
 *
 * The followings are the available model relations:
 * @property PrestacionServicios $idPrestacion
 * @property Servicio $idServicio
 */
class DetallePrestacion extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'detalle_prestacion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_prestacion, id_servicio, fecha_solicitud, cantidad, subtotal', 'required'),
            array('id_prestacion, id_servicio', 'numerical', 'integerOnly' => true),
            array('cantidad, subtotal', 'numerical'),
            array('pagado, realizado', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_detalle, id_prestacion, id_servicio, fecha_solicitud, cantidad, subtotal, pagado, realizado', 'safe', 'on' => 'search'),
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
            'idPrestacion' => array(self::BELONGS_TO, 'PrestacionServicios', 'id_prestacion'),
            'idServicio' => array(self::BELONGS_TO, 'Servicio', 'id_servicio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_detalle' => 'Id Detalle',
            'id_prestacion' => 'Id Prestacion',
            'id_servicio' => 'Id Servicio',
            'fecha_solicitud' => 'Fecha Solicitud',
            'cantidad' => 'Cantidad',
            'subtotal' => 'Subtotal',
            'pagado' => 'Pagado',
            'realizado' => 'Realizado',
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

        $criteria->compare('id_detalle', $this->id_detalle);
        $criteria->compare('id_prestacion', $this->id_prestacion);
        $criteria->compare('id_servicio', $this->id_servicio);
        $criteria->compare('fecha_solicitud', $this->fecha_solicitud, true);
        $criteria->compare('cantidad', $this->cantidad);
        $criteria->compare('subtotal', $this->subtotal);
        $criteria->compare('pagado', $this->pagado);
        $criteria->compare('realizado', $this->realizado);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetallePrestacion the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
