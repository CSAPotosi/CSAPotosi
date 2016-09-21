<?php

/**
 * This is the model class for table "sala".
 *
 * The followings are the available columns in table 'sala':
 * @property integer $id_sala
 * @property string $cod_sala
 * @property string $ubicacion_sala
 * @property integer $estado_sala
 * @property integer $id_t_sala
 *
 * The followings are the available model relations:
 * @property ServTipoSala $idTSala
 */
class Sala extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'sala';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cod_sala, id_t_sala', 'required'),
            array('estado_sala, id_t_sala', 'numerical', 'integerOnly' => true),
            array('cod_sala', 'length', 'max' => 8),
            array('ubicacion_sala', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_sala, cod_sala, ubicacion_sala, estado_sala, id_t_sala', 'safe', 'on' => 'search'),
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
            'tSala' => array(self::BELONGS_TO, 'ServTipoSala', 'id_t_sala'),
            'internacionSala'=>[self::HAS_ONE, 'InternacionSala','id_sala','condition'=>'fecha_salida is null']
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_sala' => 'Id Sala',
            'cod_sala' => 'Cod Sala',
            'ubicacion_sala' => 'Ubicacion Sala',
            'estado_sala' => 'Estado Sala',
            'id_t_sala' => 'Id T Sala',
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

        $criteria->compare('id_sala', $this->id_sala);
        $criteria->compare('cod_sala', $this->cod_sala, true);
        $criteria->compare('ubicacion_sala', $this->ubicacion_sala, true);
        $criteria->compare('estado_sala', $this->estado_sala);
        $criteria->compare('id_t_sala', $this->id_t_sala);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sala the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
