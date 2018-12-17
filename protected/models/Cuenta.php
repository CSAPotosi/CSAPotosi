<?php

/**
 * This is the model class for table "cuenta".
 *
 * The followings are the available columns in table 'cuenta':
 * @property integer $id_cuenta
 * @property string $codigo
 * @property string $nombre
 * @property string $fecha_creacion
 * @property string $fecha_inactivacion
 * @property string $descripcion
 * @property integer $nivel
 * @property integer $naturaleza
 * @property boolean $activo
 * @property integer $cuenta_superior
 *
 * The followings are the available model relations:
 * @property CuentaAsiento[] $cuentaAsientos
 * @property Cuenta $cuentaSuperior
 * @property Cuenta[] $cuentas
 */
class Cuenta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $niveles = array(1=>'CLASE',2=>'GRUPO',3=>'SUB GRUPO',4=>'CUENTA MAYOR',5=>'SUB CUENTA',6=>'AUXILIAR');
	public $tipos = array(1=>'ACREEDOR',2=>'DEUDOR');

	public function tableName()
	{
		return 'cuenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		return array(
			array('codigo, nombre, fecha_creacion, nivel, naturaleza', 'required'),
			array('nivel, naturaleza, cuenta_superior', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>15),
			array('nombre', 'length', 'max'=>127),
			array('codigo', 'validarCodigo'),
			array('codigo', 'validarRepetido','on'=>'create'),
			array('fecha_inactivacion, descripcion, activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cuenta, codigo, nombre, fecha_creacion, fecha_inactivacion, descripcion, nivel, naturaleza, activo, cuenta_superior', 'safe', 'on'=>'search'),
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
			'cuentaAsientos' => array(self::HAS_MANY, 'CuentaAsiento', 'id_cuenta'),
			'cuentaSuperior' => array(self::BELONGS_TO, 'Cuenta', 'cuenta_superior'),
			'cuentas' => array(self::HAS_MANY, 'Cuenta', 'cuenta_superior'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cuenta' => 'Id Cuenta',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_inactivacion' => 'Fecha Inactivacion',
			'descripcion' => 'Descripcion',
			'nivel' => 'Nivel',
			'naturaleza' => 'Naturaleza',
			'activo' => 'Activo',
			'cuenta_superior' => 'Cuenta Superior',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id_cuenta',$this->id_cuenta);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_inactivacion',$this->fecha_inactivacion,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('nivel',$this->nivel);
		$criteria->compare('naturaleza',$this->naturaleza);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('cuenta_superior',$this->cuenta_superior);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cuenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validarCodigo()
	{
		if($this->cuenta_superior!=null)
		{
			$codigo_superior = $this->cuentaSuperior->codigo;
			if (strlen($this->codigo)==1)
				$this->addError('codigo','Una cuenta de primer nivel, nivel de Titulo, no puede tener cuenta superior, no seleccione nada en cuenta superior');
			else
			{
				if (strpos($this->codigo,$codigo_superior)===0) {
					$dis=strlen($this->codigo)-strlen($codigo_superior);
					if($dis>2)
						$this->addError('codigo','El codigo debe tener como maximo 2 digitos más que su cuenta superior');
					elseif($dis==0)
						$this->addError('codigo','El codigo debe ser diferente al codigo de la cuenta superior');
					elseif($dis==1&&strlen($codigo_superior)>=3)
						$this->addError('codigo','El codigo debe tener dos digitos más que el codigo de la cuenta superior');
					elseif($dis==2&&strlen($codigo_superior)<3)
						$this->addError('codigo','El codigo debe solo un digito más que el codigo de la cuenta superior');
				}
				else{
					$this->addError('codigo','Los primeros digitos del codigo deben coincidir con todos los digitos del codigo de la cuenta superior');
				}
			}
		}
		else
		{
			if(strlen($this->codigo)>1)
				$this->addError('codigo','No puede dejar en blanco la cuenta Superior');
		}
	}

	public function validarRepetido()
	{
		if(Cuenta::model()->exists("codigo='$this->codigo' and activo=true" ))
			return $this->addError('codigo','El codigo escrito ya esta siendo utilizado por otra cuenta, escoja otro');
	}

	public function generarCodigo($superior="")
	{
		$sup_len = strlen($superior);
		if($sup_len<3)
			$list = Cuenta::model()->findAll(array("condition"=>"codigo like '".$superior."_' and activo = true",'order' => 'codigo'));
		else
			$list = Cuenta::model()->findAll(array("condition"=>"codigo like '".$superior."__' and activo = true",'order' => 'codigo'));
		$num = 0;
		foreach ($list as $item) {
			$aux = intval(substr($item->codigo, $sup_len));
			if ($aux - $num > 1)
				break;
			$num = intval($aux);
		}
		$num ++;
		$dig="";
		if($sup_len>=3) {
			if($num<10)
				$dig = "0".$num;
			else
				$dig = "".$num;
			if($num==100) {
				$this->addError('codigo','La cuenta alcanzó el limite de cuentas hijas');
				$dig = "";
				$num = 0;
			}
		}
		else{
			$dig = "".$num;
			if($num==10) {
				$this->addError('codigo','La cuenta alcanzó el limite de cuentas hijas');
				$dig = "";
				$num = 0;
			}
		}
		if($sup_len==0)
			$dig="";
		return $superior.$dig;
		//todo-le:controlar que al crear codigo de cuenta no pongan 0.
	}

	public function generarCodigoDeCsv($superior, $entrante, $cont)
	{
		if (strlen($superior) == strlen($entrante))
		{
			if (strlen($superior) <= 3)
			{
				$base1 = substr($superior, 0, -1);
				$base2 = substr($entrante, 0, -1);
				if ($base1 == $base2)
				{
					$dig1 = self::getdigitos($superior,1);
					$dig2 = self::getdigitos($entrante,1);
					if ($dig1 < $dig2)
						return $entrante;
					else
						throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas deben estar en orden ascendente. Error ocurrido en la linea '.$cont);
				}
				else
					throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas no tienen el orden correcto. Error ocurrido en la linea '.$cont);
			}
			else
				$base1 = substr($superior, 0, -2);
				$base2 = substr($entrante, 0, -2);
				if ($base1 == $base2)
				{
					$digs1 = self::getdigitos($superior,2);
					$digs2 = self::getdigitos($entrante,2);
					if ($digs1 < $digs2)
						return $entrante;
					else 
						throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas deben estar en orden ascendente. Error ocurrido en la linea '.$cont);
				}
				else
					throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas no tienen el orden correcto. Error ocurrido en la linea '.$cont);
		}
		else
		{
			if (strlen($superior) < strlen($entrante))
			{
				if (strlen($superior) < 3)
				{
					if($superior == substr($entrante, 0, -1))
						return $entrante;
					else
						throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas no tienen el orden correcto. Error ocurrido en la linea '.$cont);
				}	
				else
				{
					if($superior == substr($entrante, 0, -2))
						return $entrante;
					else
						throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas no tienen el orden correcto. Error ocurrido en la linea '.$cont);
				}
			}
			else
			{
				if (strlen($entrante) <= 3)
				{
					$base = substr($superior, 0, (strlen($entrante)));
					if (self::getdigitos($base, 1) < self::getdigitos($entrante, 1))
						return $entrante;
					else
						throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas no tienen el orden correcto. Error ocurrido en la linea '.$cont);
				}
				else
				{
					$base = substr($superior, 0, (strlen($entrante)));
					if (self::getdigitos($base, 2) < self::getdigitos($entrante, 2))
						return $entrante;
					else
						throw new CHttpException(400, 'El archivo .csv no tiene el formato correcto. Los digitos del codigo de las cuentas no tienen el orden correcto. Error ocurrido en la linea '.$cont);
				}	
			}
		}
	}
	
	public function getSuperior($codigo)
	{
		if(strlen($codigo) <= 3)
			return substr($codigo, 0, -1);
		else
			return substr($codigo, 0, -2);
	}

	public function getdigitos($cadena, $numdig)
	{
		$dig = substr($cadena, ($numdig*-1));
		return intval($dig);
	}

	public function getNiveles()
	{
		return $this->niveles;
	}

	public function getTipos()
	{
		return $this->tipos;
	}

	public function getCuentasList($superiores=false)
	{
		/*
		$criteria=new CDbCriteria;
		$criteria->addCondition("activo=TRUE");
		$criteria->order='codigo ASC';
		$arrayCuentas = Cuenta::model()->findAll($criteria);
		*/
		if($superiores)
			return Cuenta::model()->findAllByAttributes(array('activo'=>true),array("condition"=>"nivel<6",'order' => 'codigo'));
		return Cuenta::model()->findAllByAttributes(array('activo'=>true),array('order' => 'codigo'));
	}

	public function getCuentasListNivel($nivel)
	{
		if($nivel=='titulos')
			$cuentas = Cuenta::model()->findAllByAttributes(array('activo'=>true),array("condition"=>"nivel<4",'order' => 'codigo'));
		elseif($nivel=='mayores')
			$cuentas = Cuenta::model()->findAllByAttributes(array('activo'=>true),array("condition"=>"nivel>3",'order' => 'codigo'));
		elseif($nivel=='solomayores')
			$cuentas = Cuenta::model()->findAllByAttributes(array('activo'=>true),array("condition"=>"nivel=4",'order' => 'codigo'));
		return $cuentas;		
	}
}
