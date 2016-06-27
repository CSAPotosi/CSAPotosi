<?php

/**
 * This is the model class for table "medico_especialidad".
 *
 * The followings are the available columns in table 'medico_especialidad':
 * @property integer $id_m_e
 * @property integer $id_medico
 * @property integer $id_especialidad
 *
 * The followings are the available model relations:
 * @property Medico $idMedico
 * @property Especialidad $idEspecialidad
 */
class MedicoEspecialidad extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'medico_especialidad';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_medico, id_especialidad', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_m_e, id_medico, id_especialidad', 'safe', 'on' => 'search'),
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
            'idMedico' => array(self::BELONGS_TO, 'Medico', 'id_medico'),
            'idEspecialidad' => array(self::BELONGS_TO, 'Especialidad', 'id_especialidad'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_m_e' => 'Id M E',
            'id_medico' => 'Id Medico',
            'id_especialidad' => 'Id Especialidad',
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

        $criteria->compare('id_m_e', $this->id_m_e);
        $criteria->compare('id_medico', $this->id_medico);
        $criteria->compare('id_especialidad', $this->id_especialidad);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MedicoEspecialidad the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
