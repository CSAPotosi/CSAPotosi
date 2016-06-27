<?php

class PersonaForm extends CFormModel
{
    public $num_doc;
    public $tipo_persona;
    public $tipo_doc;
    public $nombres;
    public $primer_apellido;
    public $segundo_apellido;
    public $genero;
    public $fecha_nac;
    public $estado_civil;
    public $ocupacion;
    public $nacionalidad;
    public $localidad;
    public $domicilio;
    public $telefono;
    public $email;
    public $foto;
    public $codigo_paciente;
    public $grupo_sanguineo;
    public $fecha_deceso;
    public $responsable;
    public $fecha_contratacion;
    public $cod_maquina;
    public $matricula;

    public function attributeLabels()
    {
        return array(
            'num_doc' => 'Numero de Documento',
            'tipo_doc' => 'Tipo de Documento',
            'tipo_persona' => 'tipo_persona',
            'nombres' => 'Nombres',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segunfo Apellido',
            'genero' => 'Genero',
            'fecha_nac' => 'Fecha Nacimiento',
            'estado_civil' => 'Ocupacion',
            'nacionalidad' => 'Nacionalidad',
            'localidad' => 'Localidad',
            'domicilio' => 'Domicilio',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'foto' => 'Fotografia',
            'codigo_paciente' => 'Codigo Paciente',
            'grupo_sanguineo' => 'Grupo Sanguineo',
            'fecha_deceso' => 'fecha Deceso',
            'estado_paciente' => 'Estado Paciente',
            'responsable' => 'Responsable',
            'feccha_contratacion' => 'Fecha Contratacion',
            'estado_emp' => 'Estado Empleado',
            'cod_maquina' => 'Codigo Maquina',
            'matricula' => 'Matricula',
            'estado_med' => 'Estado Medico',
        );
    }

    public function rules()
    {
        return array(
            array('nombres, primer_apellido', 'required'),
            array('tipo_doc, estado_paciente, cod_maquina,tipo_persona', 'numerical', 'integerOnly' => true),
            array('num_doc, primer_apellido, segundo_apellido, estado_civil, ocupacion, telefono', 'length', 'max' => 32),
            array('nombres, email', 'length', 'max' => 128),
            array('codigo_paciente, matricula', 'length', 'max' => 16),
            array('grupo_sanguineo', 'length', 'max' => 8),
            array('nacionalidad', 'length', 'max' => 4),
            array('localidad, domicilio', 'length', 'max' => 64),
            array('foto', 'length', 'max' => 256),
            array('genero, fecha_nac, fecha_deceso, estado_med, fecha_contratacion, estado_emp', 'safe'),

        );
    }

    public function savePersona()
    {
        $Persona = new Persona();
        $Persona->attributes = $this->getAttributes();
        $foto = "";
        $Persona->foto = $foto;
        if (!$Persona->save())
            return 0;
        $filename = "no-photo.png";
        if (!empty($this->foto)) {
            $foto = $this->foto;
            $foto = str_replace('data:image/png;base64,', '', $foto);
            $foto = str_replace(' ', '+', $foto);
            $data_foto = base64_decode($foto);
            $filename = 'photo.png';
            $carpetaRaiz = YiiBase::getPathOfAlias("webroot") . '/images/';
            $carpetaPersonal = YiiBase::getPathOfAlias("webroot") . '/images/' . $Persona->id_persona;
            if (!file_exists($carpetaRaiz))
                mkdir($carpetaRaiz, 0777, true);
            else if (!file_exists($carpetaPersonal))
                mkdir($carpetaPersonal, 0777, true);
            $filepath = YiiBase::getPathOfAlias("webroot") . '/images/' . $Persona->id_persona . '/' . $filename;
            $writeToDisk = file_put_contents($filepath, $data_foto);
        }
        $Persona->foto = $filename;
        if ($Persona->save()) {
            $this->codigo_paciente = Yii::app()->patientTools->generateCode($this->primer_apellido, $this->segundo_apellido, $this->nombres, $this->fecha_nac);
            return $Persona->id_persona;
        } else
            return 0;
    }

    public function savePaciente()
    {
        $Paciente = new Paciente();
        $id_persona = $this->savePersona();
        if ($id_persona != 0) {
            $Paciente->id_paciente = $id_persona;
            $Paciente->attributes = $this->getAttributes();
            if ($Paciente->save())
                return $Paciente->id_paciente;
            else
                return 0;
        } else
            return false;
    }

    public function saveEmpleado()
    {
        $empleado = new Empleado();
        $id_persona = $this->savePersona();
        if ($id_persona != 0) {
            $empleado->id_empleado = $id_persona;
            $empleado->attributes = $this->getAttributes();
            if ($empleado->save())
                return true;
            else
                return false;
        } else
            return false;
    }

    public function saveMedico()
    {
        $medico = new Medico();
        $id_persona = $this->savePersona();
        if ($id_persona != 0) {
            $medico->id_medico = $id_persona;
            $medico->attributes = $this->getAttributes();
            if ($medico->save())
                return true;
            else
                return false;
        } else
            return false;
    }
    public function getTipoDocumento()
    {
        return array(
            '0' => 'Seleccione',
            '1' => 'Pasaporte',
            '2' => 'Documento Personal',
        );
    }

    public function getGenero()
    {
        return array(
            '0' => 'SELECCIONE',
            '1' => 'MASCULINO',
            '2' => 'FEMENINO',
        );
    }

    public function getEstadoCivil()
    {
        return array(
            '0' => 'SELECCIONE',
            '1' => 'SOLTERO',
            '2' => 'CASADO',
            '3' => 'DIVORCIO',
        );
    }

    public function getGrupoSanguineo()
    {
        return array(
            '0' => 'ELIJA TIPO DE SANGRE',
            '1' => 'O+',
            '2' => 'A+',
            '3' => 'A-',
            '4' => 'B+',
            '5' => 'B-',
            '6' => 'AB+',
            '7' => 'AB-',
            '8' => 'O-',
        );
    }

    public function getPais()
    {
        return CHtml::listData(pais::model()->findAll(), 'cod_pais', 'nombre_pais');
    }
}

?>