<?php

/**
 * This is the model class for table "serv_atencion_medica".
 *
 * The followings are the available columns in table 'serv_atencion_medica':
 * @property integer $id_serv
 * @property integer $id_m_e
 * @property string $cod_espe
 * @property integer $tipo_atencion
 *
 * The followings are the available model relations:
 * @property MedicoEspecialidad $idME
 */
class ServAtencionMedica extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'serv_atencion_medica';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_serv, id_m_e', 'required'),
            array('id_serv, id_m_e, tipo_atencion', 'numerical', 'integerOnly' => true),
            array('cod_espe', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_serv, id_m_e, cod_espe, tipo_atencion', 'safe', 'on' => 'search'),
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
            'idME' => array(self::BELONGS_TO, 'MedicoEspecialidad', 'id_m_e'),
            'servicio' => array(self::BELONGS_TO, 'Servicio', 'id_serv'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_serv' => 'Id Serv',
            'id_m_e' => 'Id M E',
            'cod_espe' => 'Cod Espe',
            'tipo_atencion' => 'Tipo Atencion',
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

        $criteria->compare('id_serv', $this->id_serv);
        $criteria->compare('id_m_e', $this->id_m_e);
        $criteria->compare('cod_espe', $this->cod_espe, true);
        $criteria->compare('tipo_atencion', $this->tipo_atencion);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServAtencionMedica the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
