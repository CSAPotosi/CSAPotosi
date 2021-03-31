<?php

/**
 * This is the model class for table "asiento".
 *
 * The followings are the available columns in table 'asiento':
 * @property integer $id_asiento
 * @property integer $tipo
 * @property string $fecha_registro
 * @property string $fecha
 * @property string $glosa
 * @property integer $numero_asiento
 * @property integer $numero_comprobante
 * @property integer $id_ciclo
 * @property string $referencia
 *
 * The followings are the available model relations:
 * @property CuentaAsiento[] $cuentaAsientos
 * @property CicloContable $idCiclo
 */
class Asiento extends CActiveRecord
{
	public $tipos = array(1=>'Ingreso', 2=>'Egreso', 3=>'Traspaso');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, fecha_registro, fecha, glosa, numero_asiento, numero_comprobante, id_ciclo', 'required'),
			array('tipo, numero_asiento, numero_comprobante, id_ciclo', 'numerical', 'integerOnly'=>true),
			array('glosa', 'length', 'max'=>256),
			array('referencia', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_asiento, tipo, fecha_registro, fecha, glosa, numero_asiento, numero_comprobante, id_ciclo, referencia', 'safe', 'on'=>'search'),
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
			'cuentaAsientos' => array(self::HAS_MANY, 'CuentaAsiento', 'id_asiento'),
			'idCiclo' => array(self::BELONGS_TO, 'CicloContable', 'id_ciclo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_asiento' => 'Id Asiento',
			'tipo' => 'Tipo',
			'fecha_registro' => 'Fecha Registro',
			'fecha' => 'Fecha',
			'glosa' => 'Glosa',
			'numero_asiento' => 'Numero Asiento',
			'numero_comprobante' => 'Numero Comprobante',
			'id_ciclo' => 'Id Ciclo',
			'referencia' => 'Referencia',
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

		$criteria->compare('id_asiento',$this->id_asiento);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('glosa',$this->glosa,true);
		$criteria->compare('numero_asiento',$this->numero_asiento);
		$criteria->compare('numero_comprobante',$this->numero_comprobante);
		$criteria->compare('id_ciclo',$this->id_ciclo);
		$criteria->compare('referencia',$this->referencia,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getUltimoAsiento()
	{
		$criteria = new CDbCriteria;
		$ciclo = CicloContable::cicloActual();
		if($ciclo == null)
			throw new CHttpException(505, "Aun no ha creado el Balance Inicial");
		$c = $ciclo->id_ciclo;
		$criteria->addCondition("id_ciclo='{$c}'");
		$criteria->select='max(numero_asiento) AS numero_asiento'; 
		$row = Asiento::model()->find($criteria);
		if($row==null)
			$asiento = 0;
		else
			$asiento = $row['numero_asiento'];
		return $asiento+1;
	}

	public function getUltimoComprobante($tipo)
	{
		$criteria = new CDbCriteria;
		$ciclo = CicloContable::cicloActual();
		if($ciclo == null)
			throw new CHttpException(505, "Aun no ha creado el Balance Inicial");
		$c = $ciclo->id_ciclo;
		$criteria->addCondition("id_ciclo='{$c}'");
		$criteria->addCondition("tipo='{$tipo}'");
		$criteria->select='max(numero_comprobante) AS numero_comprobante'; 
		$row = Asiento::model()->find($criteria);
		if($row==null)
			$comprobante = 0;
		else
			$comprobante = $row['numero_comprobante'];
		return $comprobante+1;
	}

	public function getTipo($tipo)
	{
		return $this->tipos[$tipo];
	}

	public function getImporte()
	{
		$total = 0;
		foreach($this->cuentaAsientos as $cuentaasiento)
			$total = $total + $cuentaasiento->debe;
		return $total;
	}

	public function getLiteral($number)
	{
		$entero = intval($number);
		$decimal = round(($number-$entero)*100);
		$cantidades = array( 900=>'NOVECIENTOS', 800=>'OCHOCIENTOS', 700=>'SETECIENTOS', 600=>'SEISCIENTOS', 500=>'QUINIENTOS',
			400=>'CUATROCIENTOS', 300=>'TRESCIENTOS', 200=>'DOSCIENTOS', 100=>'CIENTO', 90=>'NOVENTA',
			80=>'OCHENTA', 70=>'SETENTA', 60=>'SESENTA', 50=>'CINCUENTA', 40=>'CUARENTA', 30=>'TREINTA',
			29=>'VEINTINUEVE', 28=>'VEINTIOCHO', 27=>'VEINTISIETE', 26=>'VEINTISEIS', 25=>'VEINTICINCO',
			24=>'VEINTICUATRO', 23=>'VEINTITRES', 22=>'VEINTIDOS', 21=>'VEINTIUNO', 20=>'VEINTE',
			19=>'DIECINUEVE', 18=>'DIECIOCHO', 17=>'DIECISIETE', 16=>'DIECISEIS', 15=>'QUINCE', 14=>'CATORCE',
			13=>'TRECE', 12=>'DOCE', 11=>'ONCE', 10=>'DIEZ', 9=>'NUEVE', 8=>'OCHO', 7=>'SIETE', 6=>'SEIS',
			5=>'CINCO', 4=>'CUATRO', 3=>'TRES', 2=>'DOS', 1=>'UN' );
		$literal = "";
		foreach($cantidades as $cant=>$lit){
			$actual = $cant;
			if($actual*1000000 <= $entero){
				if($actual == 100 and intval($entero/1000000) == $actual)
					$literal .= 'CIEN ';
				else
					$literal .= $cantidades[$actual].' ';
				$entero -= ($actual * 1000000);
				if( 30 <= $actual and $actual <=90 and $entero>0)
					$literal .= 'Y ';
			}
		}
		if(strlen($literal)>0)
			$literal .= 'MILLONES ';
		foreach($cantidades as $cant=>$lit){
			$actual = $cant;
			if($actual*1000 <= $entero){
				if($actual == 100 and intval($entero/1000) == $actual)
					$literal .= 'CIEN ';
				else
					$literal .= $cantidades[$actual].' ';
				$entero -= ($actual * 1000);
				if( 30 <= $actual and $actual <=90 and $entero>0)
					$literal .= 'Y ';
			}
		}
		if(strlen($literal)>0)
			$literal .= 'MIL ';
		foreach($cantidades as $cant=>$lit){
			$actual = $cant;
			if($actual<=$entero){
				if($actual == 100 and $entero == $actual)
					$literal .= 'CIEN ';
				else
					$literal .= ($cantidades[$actual]).' ';
				$entero -= $actual;
				if(30<=$actual and $actual<=90 and $entero>0)
					$literal .= 'Y ';
			}
		}
		return $literal.' '.(($decimal)?$decimal:'00').'/100 Bolivianos';
	}
}
