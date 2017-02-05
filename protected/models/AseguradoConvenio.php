<?php

/**
 * This is the model class for table "asegurado_convenio".
 *
 * The followings are the available columns in table 'asegurado_convenio':
 * @property integer $id_ase_con
 * @property integer $convenio
 * @property integer $id_paciente
 * @property string $fecha_inicio
 * @property string $fecha_edicion
 * @property integer $tipo_asegurado
 * @property integer $id_paciente_titular
 * @property boolean $activo
 *
 * The followings are the available model relations:
 * @property Paciente $idPaciente
 * @property Convenio $convenio0
 * @property Paciente $idPacienteTitular
 */
class AseguradoConvenio extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'asegurado_convenio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('convenio, id_paciente, fecha_inicio,id_paciente_titular', 'required'),
            array('convenio, id_paciente, tipo_asegurado, id_paciente_titular', 'numerical', 'integerOnly' => true),
            array('fecha_edicion, activo', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_ase_con, convenio, id_paciente, fecha_inicio, fecha_edicion, tipo_asegurado, id_paciente_titular, activo', 'safe', 'on' => 'search'),
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
            'paciente' => array(self::BELONGS_TO, 'Paciente', 'id_paciente'),
            'pacienteConvenio' => array(self::BELONGS_TO, 'Convenio', 'convenio'),
            'pacienteTitular' => array(self::BELONGS_TO, 'Paciente', 'id_paciente_titular'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_ase_con' => 'Id Ase Con',
            'convenio' => 'Convenio',
            'id_paciente' => 'Id Paciente',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_edicion' => 'Fecha Edicion',
            'tipo_asegurado' => 'Tipo Asegurado',
            'id_paciente_titular' => 'Paciente Tutular',
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

        $criteria->compare('id_ase_con', $this->id_ase_con);
        $criteria->compare('convenio', $this->convenio);
        $criteria->compare('id_paciente', $this->id_paciente);
        $criteria->compare('fecha_inicio', $this->fecha_inicio, true);
        $criteria->compare('fecha_edicion', $this->fecha_edicion, true);
        $criteria->compare('tipo_asegurado', $this->tipo_asegurado);
        $criteria->compare('id_paciente_titular', $this->id_paciente_titular);
        $criteria->compare('activo', $this->activo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AseguradoConvenio the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getTipoAsegurado()
    {
        return array(
            '1' => 'TITULAR',
            '2' => 'BENEFICIARIO',
        );
    }

    public function getConvenios()
    {
        return CHtml::listData(Convenio::model()->findAll(), 'id_convenio', 'nombre_convenio');
    }

    public function getActivo()
    {
        return array(
            't' => 'ACTIVO',
            'f' => 'INACTIVO'
        );    
    }
}
