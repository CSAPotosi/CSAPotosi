<?php

/**
 * This is the model class for table "convenio".
 *
 * The followings are the available columns in table 'convenio':
 * @property integer $id_convenio
 * @property string $fecha_creacion
 * @property string $fecha_edicion
 * @property string $nombre_convenio
 * @property boolean $activo
 * @property integer $id_entidad
 *
 * The followings are the available model relations:
 * @property Entidad $idEntidad
 * @property ConvenioServicio[] $convenioServicios
 */
class Convenio extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'convenio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fecha_creacion, nombre_convenio, id_entidad', 'required'),
            array('id_entidad', 'numerical', 'integerOnly' => true),
            array('nombre_convenio', 'length', 'max' => 128),
            array('fecha_edicion, activo', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_convenio, fecha_creacion, fecha_edicion, nombre_convenio, activo, id_entidad', 'safe', 'on' => 'search'),
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
            'entidad' => array(self::BELONGS_TO, 'Entidad', 'id_entidad'),
            'convenioServicios' => array(self::HAS_MANY, 'ConvenioServicio', 'id_convenio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_convenio' => 'Id Convenio',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_edicion' => 'Fecha Edicion',
            'nombre_convenio' => 'Nombre Convenio',
            'activo' => 'Activo',
            'id_entidad' => 'Id Entidad',
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

        $criteria->compare('id_convenio', $this->id_convenio);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('fecha_edicion', $this->fecha_edicion, true);
        $criteria->compare('nombre_convenio', $this->nombre_convenio, true);
        $criteria->compare('activo', $this->activo);
        $criteria->compare('id_entidad', $this->id_entidad);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Convenio the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeValidate()
    {
        $this->fecha_edicion = date('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->fecha_creacion = date('Y-m-d H:i:s');
        }
        return parent::beforeValidate();
    }

    public function getEntidad()
    {
        return CHtml::listData(Entidad::model()->findAll(), 'id_entidad', 'razon_social');
    }
}
