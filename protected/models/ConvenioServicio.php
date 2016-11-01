<?php

/**
 * This is the model class for table "convenio_servicio".
 *
 * The followings are the available columns in table 'convenio_servicio':
 * @property integer $id_con_ser
 * @property double $descuento_servicio
 * @property boolean $activo
 * @property integer $id_convenio
 * @property integer $id_servicio
 *
 * The followings are the available model relations:
 * @property Convenio $idConvenio
 * @property Servicio $idServicio
 */
class ConvenioServicio extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'convenio_servicio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('descuento_servicio, id_convenio, id_servicio', 'required'),
            array('id_convenio, id_servicio', 'numerical', 'integerOnly' => true),
            array('descuento_servicio', 'numerical', 'max' => 100, 'min' => 0),
            array('activo', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_con_ser, descuento_servicio, activo, id_convenio, id_servicio', 'safe', 'on' => 'search'),
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
            'idConvenio' => array(self::BELONGS_TO, 'Convenio', 'id_convenio'),
            'servicio' => array(self::BELONGS_TO, 'Servicio', 'id_servicio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_con_ser' => 'Id Con Ser',
            'descuento_servicio' => 'Descuento Servicio',
            'activo' => 'Activo',
            'id_convenio' => 'Id Convenio',
            'id_servicio' => 'Id Servicio',
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

        $criteria->compare('id_con_ser', $this->id_con_ser);
        $criteria->compare('descuento_servicio', $this->descuento_servicio);
        $criteria->compare('activo', $this->activo);
        $criteria->compare('id_convenio', $this->id_convenio);
        $criteria->compare('id_servicio', $this->id_servicio);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ConvenioServicio the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
