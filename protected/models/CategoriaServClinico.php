<?php

/**
 * This is the model class for table "categoria_serv_clinico".
 *
 * The followings are the available columns in table 'categoria_serv_clinico':
 * @property integer $id_cat_cli
 * @property string $cod_cat_cli
 * @property string $nombre_cat_cli
 * @property string $descripcion_cat_cli
 * @property boolean $activo
 *
 * The followings are the available model relations:
 * @property ServClinico[] $servClinicos
 */
class CategoriaServClinico extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'categoria_serv_clinico';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cod_cat_cli, nombre_cat_cli', 'required'),
            array('cod_cat_cli', 'length', 'max' => 8),
            array('nombre_cat_cli', 'length', 'max' => 64),
            array('descripcion_cat_cli, activo', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_cat_cli, cod_cat_cli, nombre_cat_cli, descripcion_cat_cli, activo', 'safe', 'on' => 'search'),
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
            'servClinicos' => array(self::HAS_MANY, 'ServClinico', 'id_cat_cli'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_cat_cli' => 'Id Cat Cli',
            'cod_cat_cli' => 'Cod Cat Cli',
            'nombre_cat_cli' => 'Nombre Cat Cli',
            'descripcion_cat_cli' => 'Descripcion Cat Cli',
            'activo' => 'Activo',
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

        $criteria->compare('id_cat_cli', $this->id_cat_cli);
        $criteria->compare('cod_cat_cli', $this->cod_cat_cli, true);
        $criteria->compare('nombre_cat_cli', $this->nombre_cat_cli, true);
        $criteria->compare('descripcion_cat_cli', $this->descripcion_cat_cli, true);
        $criteria->compare('activo', $this->activo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CategoriaServClinico the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
