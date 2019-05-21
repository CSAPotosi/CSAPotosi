<?php

/**
 * This is the model class for table "audit_report".
 *
 * The followings are the available columns in table 'audit_report':
 * @property integer $id_au_report
 * @property integer $user_id
 * @property string $fecha_report
 * @property string $name_report
 * @property string $content_report
 */
class AuditReport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'audit_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name_report, content_report', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_au_report, user_id, fecha_report, name_report, content_report', 'safe', 'on'=>'search'),
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
            'usuario' => array(self::BELONGS_TO, 'Usuario', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_au_report' => 'Id Au Report',
			'user_id' => 'User',
			'fecha_report' => 'Fecha Report',
			'name_report' => 'Name Report',
			'content_report' => 'Content Report',
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AuditReport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        $this->fecha_report = date('Y-m-d H:i:s');
        $this->user_id = 1;
        return parent::beforeSave();
    }
}
