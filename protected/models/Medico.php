<?php

/**
 * This is the model class for table "medico".
 *
 * The followings are the available columns in table 'medico':
 * @property integer $id_medico
 * @property string $matricula
 * @property boolean $estado_med
 *
 * The followings are the available model relations:
 * @property Persona $idMedico
 */
class Medico extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'medico';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_medico, matricula', 'required'),
            array('id_medico', 'numerical', 'integerOnly' => true),
            array('matricula', 'length', 'max' => 16),
            array('estado_med', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_medico, matricula, estado_med', 'safe', 'on' => 'search'),
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
            'idMedico' => array(self::BELONGS_TO, 'Persona', 'id_medico'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_medico' => 'Id Medico',
            'matricula' => 'Matricula',
            'estado_med' => 'Estado Med',
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

        $criteria->compare('id_medico', $this->id_medico);
        $criteria->compare('matricula', $this->matricula, true);
        $criteria->compare('estado_med', $this->estado_med);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Medico the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
