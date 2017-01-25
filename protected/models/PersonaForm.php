<?php

class PersonaForm extends CFormModel
{
    //persona
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
    //paciente
    public $codigo_paciente;
    public $grupo_sanguineo;
    public $fecha_deceso;
    public $responsable;
    //empelado
    public $fecha_contratacion;
    public $cod_maquina;
    //medico
    public $matricula;
    //objetos
    private $modelPersona;
    private $modelPaciente;
    private $modelEmpleado;
    private $modelMedico;

    public function attributeLabels()
    {
        return array(
            'num_doc' => 'Numero de Documento',
            'tipo_doc' => 'Tipo de Documento',
            'tipo_persona' => 'tipo_persona',
            'nombres' => 'NOMBRES',
            'primer_apellido' => 'PRIMER APELLIDO',
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
            'fecha_contratacion' => 'Fecha Contratacion',
            'estado_emp' => 'Estado Empleado',
            'cod_maquina' => 'Codigo Maquina',
            'matricula' => 'Matricula',
            'estado_med' => 'Estado Medico',
        );
    }

    public function rules()
    {
        return array(
            array('nombres, primer_apellido, fecha_nac,fecha_contratacion', 'required'),
            array('tipo_doc, estado_paciente, cod_maquina,tipo_persona', 'numerical', 'integerOnly' => true),
            array('num_doc, primer_apellido, segundo_apellido, estado_civil, ocupacion, telefono', 'length', 'max' => 32),
            array('nombres, email,responsable', 'length', 'max' => 128),
            array('codigo_paciente, matricula', 'length', 'max' => 16),
            array('matricula', 'unique'),
            array('grupo_sanguineo', 'length', 'max' => 8),
            array('nacionalidad', 'length', 'max' => 4),
            array('localidad, domicilio', 'length', 'max' => 64),
            array('foto', 'length', 'max' => 256),
            array('genero, fecha_nac, fecha_deceso, estado_med, fecha_contratacion, estado_emp', 'safe'),

        );
    }

    public function savePersona()
    {
        $this->modelPersona->save();
        $foto = "";
        $this->modelPersona->foto = $foto;
        $filename = "no-photo.png";
        if (!empty($this->foto)) {
            $foto = $this->foto;
            $foto = str_replace('data:image/png;base64,', '', $foto);
            $foto = str_replace(' ', '+', $foto);
            $data_foto = base64_decode($foto);
            $filename = 'photo.png';
            $carpetaRaiz = YiiBase::getPathOfAlias("webroot") . '/images/';
            $carpetaPersonal = YiiBase::getPathOfAlias("webroot") . '/images/' . $this->modelPersona->id_persona;
            if (!file_exists($carpetaRaiz))
                mkdir($carpetaRaiz, 0777, true);
            else if (!file_exists($carpetaPersonal))
                mkdir($carpetaPersonal, 0777, true);
            $filepath = YiiBase::getPathOfAlias("webroot") . '/images/' . $this->modelPersona->id_persona . '/' . $filename;
            $writeToDisk = file_put_contents($filepath, $data_foto);
        }
        $this->modelPersona->foto = $filename;
        if ($this->modelPersona->save()) {
            return $this->modelPersona->id_persona;
        } else
            return 0;
    }

    public function loadPersona($id)
    {
        if ($id == null) {
            $this->modelPersona = new Persona();
        } else {
            $this->modelPersona = Persona::model()->findByPk($id);
        }

        $this->modelPersona->setAttributes($this->getAttributes(), false);
        $this->modelPersona->foto = "";

    }

    public function savePaciente($id = null)
    {
        $id_persona = 0;
        $this->modelPaciente = ($id == null) ? new Paciente() : Paciente::model()->findByPk($id);
        $this->modelPaciente->setAttributes($this->getAttributes(), false);
        $this->modelPaciente->id_paciente = ($id == null) ? 1 : $this->modelPaciente->id_paciente;
        $this->loadPersona($id);
        if ($this->validar([$this->modelPersona, $this->modelPaciente])) {
            $val = Persona::model()->findAll(['condition' => "num_doc='{$this->modelPersona->num_doc}'"]);
            if ($val != array() && $id == null) {
                if (!$val[0]->paciente) {
                    $historial = new HistorialMedico();
                    $this->modelPaciente->id_paciente = $val[0]->id_persona;
                    $this->modelPaciente->estado_paciente = 1;
                    $historial->id_historial = $val[0]->id_persona;
                    $this->modelPaciente->save();
                    $historial->save();
                    $id_persona = $historial->id_historial;
                }
            } else {
                $valor = $this->savePersona();
                $this->modelPaciente->codigo_paciente = Yii::app()->patientTools->generateCode($this->modelPersona->primer_apellido, $this->modelPersona->segundo_apellido, $this->modelPersona->nombres, $this->modelPersona->fecha_nac);
                if ($id == null) {
                    $historial = new HistorialMedico();
                    $this->modelPaciente->id_paciente = $valor;
                    $this->modelPaciente->estado_paciente = 1;
                    $historial->id_historial = $valor;
                    $this->modelPaciente->save();
                    $historial->save();
                    $id_persona = $historial->id_historial;
                } else {

                    $this->modelPaciente->save();
                    $id_persona = $this->modelPaciente->id_paciente;
                }
            }
        }
        return $id_persona;
    }

    public function saveEmpleado($id = null)
    {
        $id_persona = 0;
        $this->modelEmpleado = ($id == null) ? new Empleado() : Empleado::model()->findByPk($id);
        $this->modelEmpleado->setAttributes($this->getAttributes(), false);
        $this->modelEmpleado->id_empleado = ($id == null) ? 1 : $this->modelEmpleado->id_empleado;
        $this->loadPersona($id);
        if ($this->validar([$this->modelPersona, $this->modelEmpleado])) {
            $val = Persona::model()->findAll(['condition' => "num_doc='{$this->modelPersona->num_doc}'"]);
            if ($val != array() && $id == null) {
                if (!$val[0]->empleado) {
                    $this->modelEmpleado->id_empleado = $val[0]->id_persona;
                    $this->modelEmpleado->save();
                    $id_persona = $this->modelEmpleado->id_empleado;
                }
            } else {
                $valor = $this->savePersona();
                if ($id == null) {
                    $this->modelEmpleado->id_empleado = $valor;
                    $this->modelEmpleado->save();
                    $id_persona = $this->modelEmpleado->id_empleado;
                } else {
                    $this->modelEmpleado->save();
                    $id_persona = $this->modelEmpleado->id_empleado;
                }
            }
        }
        return $id_persona;
    }

    public function saveMedico($id = null)
    {
        $id_persona = 0;
        $this->modelMedico = ($id == null) ? new Medico() : Medico::model()->findByPk($id);
        $this->modelMedico->setAttributes($this->getAttributes(), false);
        $this->modelMedico->id_medico = ($id == null) ? 1 : $this->modelMedico->id_medico;
        $this->loadPersona($id);
        if ($this->validar([$this->modelPersona, $this->modelMedico])) {
            $val = Persona::model()->findAll(['condition' => "num_doc='{$this->modelPersona->num_doc}'"]);
            if ($val != array() && $id == null) {
                if (!$val[0]->medico) {
                    $this->modelMedico->id_medico = $val[0]->id_persona;
                    $this->modelMedico->save();
                    $id_persona = $this->modelMedico->id_Medico;
                }
            } else {
                $valor = $this->savePersona();
                if ($id == null) {
                    $this->modelMedico->id_medico = $valor;
                    $this->modelMedico->save();
                    $id_persona = $this->modelMedico->id_medico;
                } else {
                    $this->modelMedico->save();
                    $id_persona = $this->modelMedico->id_medico;
                }
            }
        }
        return $id_persona;
    }

    private function validar($modelList = [])
    {
        foreach ($modelList as $model) {
            $model->validate();
            $this->addErrors($model->getErrors());
        }
        if ($this->hasErrors())
            return false;
        return true;
    }
    public function getTipoDocumento()
    {
        return array(
            '0' => 'Seleccione',
            '1' => 'CARNET DE IDENTIDAD',
            '2' => 'LIBRETA O DNI',
            '3' => 'PASAPORTE',
            '4' => 'PART. NACIMIENTO-IDENTIDAD'
        );
    }

    public function getGenero()
    {
        return array(
            'true' => 'MASCULINO',
            'false' => 'FEMENINO',
        );
    }

    public function getEstadoCivil()
    {
        return array(
            '0' => 'SELECCIONE',
            '1' => 'SOLTERO(A)',
            '2' => 'CASADO(A)',
            '3' => 'DIVORCIADO(A)',
            '4' => 'VIUDO(A)',
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