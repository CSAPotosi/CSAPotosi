<?php
class PatientTools extends CApplicationComponent{

	public function generateCode($primer_apellido='',$segundo_apellido='',$nombres='',$fecha_nac=''){
		$code=date('ymd',strtotime($fecha_nac));
		$name=$this->getFirstChars(implode(" ",[$primer_apellido,$segundo_apellido,$nombres]));
		$code.=$name;
		return strtoupper($code);
	}

	private function getFirstChars($cadena=''){
		$listWords=explode(" ",$cadena);
		$cadena='';
		foreach($listWords as $word)
			$cadena.=substr($word,0,1);
		return $cadena;
	}
}