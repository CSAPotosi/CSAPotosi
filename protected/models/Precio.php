<?php

/**
 * This is the model class for table "precio".
 *
 * The followings are the available columns in table 'precio':
 * @property integer $id_precio
 * @property integer $id_serv
 * @property string $monto
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property boolean $activo
 *
 * The followings are the available model relations:
 * @property Servicio $idServ
 */
class Precio extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'precio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('monto', 'required'),
            array('id_serv', 'numerical', 'integerOnly' => true),
            array('monto', 'numerical'),
            array('fecha_fin, activo', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_precio, id_serv, monto, fecha_inicio, fecha_fin, activo', 'safe', 'on' => 'search'),
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
            'servicio' => array(self::BELONGS_TO, 'Servicio', 'id_serv'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_precio' => 'ID PRECIO',
            'id_serv' => 'ID DE SERVICIO',
            'monto' => 'MONTO',
            'fecha_inicio' => 'FECHA INICIO',
            'fecha_fin' => 'FECHA FIN',
            'activo' => 'ESTADO',
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

        $criteria->compare('id_precio', $this->id_precio);
        $criteria->compare('id_serv', $this->id_serv);
        $criteria->compare('monto', $this->monto, true);
        $criteria->compare('fecha_inicio', $this->fecha_inicio, true);
        $criteria->compare('fecha_fin', $this->fecha_fin, true);
        $criteria->compare('activo', $this->activo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Precio the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->fecha_inicio = date("Y-m-d");
            $this->activo = TRUE;
        } else {
            $this->activo = FALSE;
            $this->fecha_fin = date("Y-m-d");

        }
        return parent::beforeSave();
    }
}
