<?php

/**
 * This is the model class for table "serv_tipo_sala".
 *
 * The followings are the available columns in table 'serv_tipo_sala':
 * @property integer $id_serv
 * @property string $descripcion_t_sala
 *
 * The followings are the available model relations:
 * @property Servicio $servicio
 * @property Sala[] $salas
 */
class ServTipoSala extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'serv_tipo_sala';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_serv', 'numerical', 'integerOnly' => true),
            array('descripcion_t_sala', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_serv, descripcion_t_sala', 'safe', 'on' => 'search'),
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
            'salas' => array(self::HAS_MANY, 'Sala', 'id_t_sala'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_serv' => 'Id Serv',
            'descripcion_t_sala' => 'Descripcion T Sala',
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
        $criteria->compare('descripcion_t_sala', $this->descripcion_t_sala, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServTipoSala the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
