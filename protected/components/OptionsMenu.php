<?php
class OptionsMenu{

    public static function menuPaciente($params = [], $selected = ['','']){
        $menu = [
            'pacientes'=>[
                'label' => '<i class="fa fa-group"></i> PACIENTES',
                'items'=>[
                    'Lista Paciente' => ['url' => ['paciente/index'], 'label' => 'LISTA'],
                    'Crear Paciente' => ['url' => ['paciente/create'], 'label' => 'NUEVO'],
                    'Paciente Emergencia' => ['url' => ['paciente/emergencia'], 'label' => 'EMERGENCIA']
                ]
            ]
        ];
        if (isset($params['id_paciente'])) {
            $paciente = Paciente::model()->findByPk($params['id_paciente']);
            $menu2 = [
                'label' => '<i class="fa fa-user"></i>' . $paciente->persona->getNombreCompleto(),
                'items' => [
                    'Detalle Paciente' => ['url' => ['paciente/detallePaciente', 'id' => $params['id_paciente']], 'label' => 'DETALLE PACIENTE'],
                    'Actualizar Paciente' => ['url' => ['paciente/update', 'id' => $params['id_paciente']], 'label' => 'ACTUALIZAR PACIENTE'],
                    'Prestacion Servicios' => ['url' => ['HistorialMedico/externoCreate', 'id' => $params['id_paciente']], 'label' => 'PRESTACION DE SERVICIOS'],
                    'Seguro Paciente' => ['url' => ['paciente/seguroPaciente', 'id' => $params['id_paciente']], 'label' => 'SEGURO DE PACIENTE'],
                    'Seguro Create' => ['url' => ['paciente/seguroCreate', 'id' => $params['id_paciente']], 'label' => 'ASEGURAR PACIENTE'],
                    'Cita' => ['url' => ['cita/indexCita', 'id' => $params['id_paciente']], 'label' => 'DAR CITA']
                ]
            ];
            $menu['paciente'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuEmpleado($params = [], $selected = ['', ''])
    {
        $menu = [
            'empleados' => [
                'label' => '<i class="fa fa-suitcase"></i></i> Empleados',
                'items' => [
                    'Lista Empleado' => ['url' => ['empleado/index'], 'label' => ' LISTA'],
                    'Crear Empleado' => ['url' => ['empleado/Create'], 'label' => 'NUEVO EMPLEADO']

                ]
            ]
        ];
        if (isset($params['id_empleado'])) {
            $empleado = Empleado::model()->findByPk($params['id_empleado']);
            $menu2 = [
                'label' => '<i class="fa fa-user"></i>' . $empleado->empleadoPersona->getNombreCompleto(),
                'items' => [
                    'Detalle Empleado' => ['url' => ['empleado/detalleEmpleado', 'id' => $params['id_empleado']], 'label' => 'DETALLE DE EMPLEADO'],
                    'Actualizar Empleado' => ['url' => ['empleado/update', 'id' => $params['id_empleado']], 'label' => 'ACTUALIZAR EMPLEADO'],
                ]
            ];
            $menu['empleado'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuMedico($params = [], $selected = ['', ''])
    {
        $menu = [
            'medicos' => [
                'label' => '<i class="fa fa-medkit"></i></i> MEDICOS',
                'items' => [
                    'Lista Medicos' => ['url' => ['medico/index'], 'label' => '<i class="fa fa-th-list"></i> LISTA'],
                    'Crear Medicos' => ['url' => ['medico/Create'], 'label' => '<i class="fa fa-plus"></i> NUEVO MEDICO']

                ]
            ]
        ];
        if (isset($params['id_medico'])) {
            $medico = Medico::model()->findByPk($params['id_medico']);
            $menu2 = [
                'label' => '<i class="fa fa-user"></i>' . $medico->persona->getNombreCompleto(),
                'items' => [
                    'Detalle Medicos' => ['url' => ['medico/detalleMedico', 'id' => $params['id_medico']], 'label' => 'DETALLE'],
                    'Actualizar Medico' => ['url' => ['medico/update', 'id' => $params['id_medico']], 'label' => 'ACTUALIZAR'],
                ]
            ];
            $menu['medico'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuUnidad($params = [], $selected = ['', ''])
    {
        $menu = [
            'unidades' => [
                'label' => '<i class=""></i></i> UNIDADES',
                'items' => [
                    'Lista Unidad' => ['url' => ['unidad/index'], 'label' => ' LISTA'],
                    'Crear Unidad' => ['url' => ['unidad/Create'], 'label' => 'NUEVA UNIDAD']

                ]
            ]
        ];
        if (isset($params['id_unidad'])) {
            $unidad = Unidad::model()->findByPk($params['id_unidad']);
            $menu2 = [
                'label' => '<i class="fa fa-list"></i>' . $unidad->nombre_unidad,
                'items' => [
                    'Actualizar Unidad' => ['url' => ['unidad/update', 'id' => $params['id_unidad']], 'label' => 'EDITAR UNIDAD'],
                    'Lista Cargos' => ['url' => ['cargo/index', 'id' => $params['id_unidad']], 'label' => 'CARGOS DE UNIDAD'],
                    'Crear Cargo' => ['url' => ['cargo/create', 'id' => $params['id_unidad']], 'label' => 'NUEVA CARGO'],
                ]
            ];
            $menu['unidad'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }
    public static function menuConvenio($params = [], $selected = ['', ''])
    {
        $menu = [
            'convenios' => [
                'label' => '<i class="fa fa-archive"></i></i> CONVENIOS',
                'items' => [
                    'Lista Convenio' => ['url' => ['convenio/indexConvenio'], 'label' => 'LISTA'],
                ]
            ]
        ];
        if (isset($params['id_convenio'])) {
            $convenio = Convenio::model()->findByPk($params['id_convenio']);
            $menu2 = [
                'label' => '<i class=""></i>' . $convenio->nombre_convenio,
                'items' => [
                    'Convenio Servicio' => ['url' => ['convenio/indexServicioConvenio', 'id' => $params['id_convenio']], 'label' => 'DETALLE DE CONVENIO'],
                ]
            ];
            $menu['convenio'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuAsignacion($params = [], $selected = ['', ''])
    {
        $menu = [
            'asignaciones' => [
                'label' => '<i class=""></i>ASIGNACIONES</i>',
                'items' => [
                    'Lista Asignacion' => ['url' => ['AsignacionEmpleado/index'], 'label' => '<i class="fa fa-th-list"></i> LISTA'],
                    'Crear Asignacion' => ['url' => ['AsignacionEmpleado/Create'], 'label' => '<i class="fa fa-plus"></i> NUEVA ASIGNACION'],

                ]
            ]
        ];
        $menu3 = [
            'label' => '<i class=""></i>ASISTENCIA',
            'items' => [
                'Cargar Asistencia' => ['url' => ['Registro/subir'], 'label' => 'CARGAR ASISTENCIA'],
                'Crear Registro' => ['url' => ['Registro/Create'], 'label' => 'REGISTRO MANUAL'],
                'Registro Automatico' => ['url' => ['Registro/registroManual'], 'label' => 'REGISTRO AUTOMATICO'],
                'Informacion Asistencia' => ['url' => ['Registro/reportAsistencia'], 'label' => 'INFORMACION DE ASISTENCIA'],
            ]
        ];
        $menu['asistencia'] = $menu3;
        if (isset($params['id_asignacion'])) {
            $asignacion = AsignacionEmpleado::model()->findByPk($params['id_asignacion']);
            $menu2 = [
                'label' => '<i class=""></i>' . $asignacion->empleado->empleadoPersona->getNombreCompleto(),
                'items' => [
                    'Actualizar Asignacion' => ['url' => ['AsignacionEmpleado/update', 'id' => $params['id_asignacion']], 'label' => 'EDITAR ASIGNACION'],
                ]
            ];
            $menu['asignacion'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuHorario($params = [], $selected = ['', ''])
    {
        $menu = [
            'horarios' => [
                'label' => '<i class="fa fa-clock-o"></i></i> HORARIOS',
                'items' => [
                    'Lista Horario' => ['url' => ['horario/index'], 'label' => '<i class="fa fa-th-list"></i> LISTA'],
                    'Crear Horario' => ['url' => ['horario/Create'], 'label' => '<i class="fa fa-plus"></i> NUEVO HORARIO']
                ]
            ]
        ];
        if (isset($params['id_horario'])) {
            $horario = Horario::model()->findByPk($params['id_horario']);
            $menu2 = [
                'label' => '<i class=""></i>' . $horario->nombre_horario,
                'items' => [
                    'Actualizar Horario' => ['url' => ['horario/update', 'id' => $params['id_horario']], 'label' => 'EDITAR'],
                    'Crear Periodo' => ['url' => ['horario/createPeriodo', 'id' => $params['id_horario']], 'label' => 'PERIODOS'],
                ]
            ];
            $menu['horario'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }
    public static function menuHistorial($params = [], $selected = ['','']){
        $menu = [
            'historial'=>[
                'label'=>'<i class="fa fa-files-o"></i>Historial',
                'items'=>[
                    'antecedentes_Index'=>['url'=>['antecedentes/index','h_id'=>$params['h_id']],'label'=>'Antecedentes'],
                    'indexHistorial'=>['url'=>['historialMedico/index','id_paciente'=>$params['h_id']], 'label'=>'<i class="fa fa-files-o"></i>Historial'],
                    'diagnostico_Crear'=>['url'=>['diagnostico/create','h_id'=>$params['h_id']],'label'=>'<i class="fa fa-stethoscope"></i>Nuevo diagnostico'],
                    'vitales_Index'=>['url'=>['vitales/index','h_id'=>$params['h_id']],'label'=>'Signos vitales']
                ]   
            ]
        ];

        if(isset($params['h_id'])){
            $hisTemp = HistorialMedico::model()->findByPk($params['h_id']);
            $interModel = $hisTemp->internacionActual;
            if($interModel)
                $menu['historial']['items']['internacion_Index'] = ['url'=>['internacion/index','i_id'=>$interModel->id_inter],'label'=>'Ver internacion actual'];
            else
                $menu['historial']['items']['internacion_CreateIngreso'] = ['url'=>['internacion/createIngreso', 'h_id'=>$params['h_id']], 'label'=>'<i class="fa fa-ambulance"></i>Internar paciente'];
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuSalas($params=[],$selected = ['','']){
        $menu = [
            'tipoSala'=>[
                'label'=>'GRUPOS DE SALAS',
                'items'=>[
                    'salaList'=>['url'=>['servicio/index','grupo'=>'sala'],'label'=>'LISTA'],
                    'salaCreate'=>['url'=>['servicio/create','grupo'=>'sala'],'label'=>'NUEVO']
                ]
            ]
        ];
        if(isset($params['ts_id'])){
            $tsModel = ServTipoSala::model()->findByPk($params['ts_id']);
            if($tsModel != null){
                $menu2 = [
                    'label'=>$tsModel->servicio->nombre_serv,
                    'items'=>[
                        'salaView'=>['url'=>['servicio/view','grupo'=>'sala','id'=>$tsModel->id_serv], 'label'=>'DETALLE'],
                        'salaUpdate'=>['url'=>['servicio/update','grupo'=>'sala','id'=>$tsModel->id_serv], 'label'=>'EDITAR']
                    ]
                ];
                $menu['itemTSala']=$menu2;
            }
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuExamenLab($params = [], $selected = ['', ''])
    {
        if ($params['tipo'] == 1) {
            $menu = [
                'examenLab' => [
                    'label' => '<i class="fa fa-flask"></i></i> EX. DE LABORATORIO',
                    'items' => [
                        'Lista ExamenLab' => ['url' => ['servicio/index', 'grupo' => 'examen', 'tipo' => '1'], 'label' => ' LISTA'],
                        'Crear ExamenLab' => ['url' => ['servicio/create', 'grupo' => 'examen', 'tipo' => '1'], 'label' => 'NUEVO EXAMEN'],
                        'Categorias Laboratorio' => ['url' => ['CategoriaServicio/index', 'grupo' => 'examen', 'tipo' => '1'], 'label' => 'NUEVA CATEGORIA']
                    ]
                ]
            ];
        }
        if ($params['tipo'] == 2) {
            $menu = [
                'examenLab' => [
                    'label' => '<i class="fa fa-image"></i></i> EX. DE RAYOS X',
                    'items' => [
                        'Lista ExamenLab' => ['url' => ['servicio/index', 'grupo' => 'examen', 'tipo' => '2'], 'label' => 'LISTA'],
                        'Crear ExamenLab' => ['url' => ['servicio/create', 'grupo' => 'examen', 'tipo' => '2'], 'label' => 'NUEVO EXAMEN'],
                        'Categorias Laboratorio' => ['url' => ['CategoriaServicio/index', 'grupo' => 'examen', 'tipo' => '2'], 'label' => 'NUEVA CATEGORIA']
                    ]
                ]
            ];
        }
        if ($params['tipo'] == 3) {
            $menu = [
                'examenLab' => [
                    'label' => '<i class="fa fa-hospital-o"></i></i> SERVICIOS CLINICOS',
                    'items' => [
                        'Lista ExamenLab' => ['url' => ['servicio/index', 'grupo' => 'clinico', 'tipo' => '3'], 'label' => 'LISTA'],
                        'Crear ExamenLab' => ['url' => ['servicio/create', 'grupo' => 'clinico', 'tipo' => '3'], 'label' => 'NUEVO SERVICIO CLINICO'],
                        'Categorias Laboratorio' => ['url' => ['CategoriaServicio/index', 'grupo' => 'clinico', 'tipo' => '3'], 'label' => 'NUEVA CATEGORIA']
                    ]
                ]
            ];
        }
        if (isset($params['id_servicio'])) {
            $servicio = ServExamen::model()->findByPk($params['id_servicio']);
            $menu2 = [
                'label' => '<i class=""></i>' . $servicio->datosServicio->nombre_serv,
                'items' => [
                    'Actualizar' => ['url' => ['servicio/update', 'id' => $params['id_servicio']], 'label' => 'ACTUALIZAR'],
                ]
            ];
            $menu['examenLabs'] = $menu2;
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuAtencionMedica($params = [], $selected = ['', ''])
    {
        $menu = [
            'atenciones' => [
                'label' => 'ATENCIONES MEDICAS',
                'items' => [
                    'index' => ['url' => ['servicio/atencionMedicaIndex', 'grupo' => 'sala', 'tipo' => '4'], 'label' => 'LISTA'],
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }
    public static function menuInternacion($params = [], $selected = ['','']){
        $iModel = Internacion::model()->findByPk($params['i_id']);
        $i_id = $iModel->id_inter;$h_id=$iModel->id_historial;
        $menu = [
            'historial'=>[
                'label'=>'<i class="fa fa-files-o"></i>Historial',
                'items'=>[
                    'indexHistorial'=>['url'=>['historialMedico/index','id_paciente'=>$h_id], 'label'=>'<i class="fa fa-files-o"></i>Historial'],
                    'diagnostico_Crear'=>['url'=>['diagnostico/create','h_id'=>$h_id],'label'=>'<i class="fa fa-stethoscope"></i>Nuevo diagnostico']
                ]
            ],
            'internacion'=>[
                'label'=>'Internacion',
                'items'=>[
                    'internacion_Index'=>['url'=>['internacion/index','i_id'=>$i_id], 'label'=>'Indice'],
                    'prestacionServicios_IndexForInter'=>['url'=>['prestacionServicios/indexForInter','i_id'=>$i_id],'label'=>'Servicios prestados'],
                    'prestacionServicios_CreateForInter'=>['url'=>['prestacionServicios/createForInter','i_id'=>$i_id], 'label'=>'Agregar servicios'],
                    'internacion_Alta'=>['url'=>['internacion/alta','i_id'=>$i_id],'label'=>'Alta'],
                    'notaEnfermeria_Index'=>['url'=>['notaEnfermeria/index','i_id'=>$i_id],'label'=>'Notas de enfermeria'],
                    'internacion_ChangeSala'=>['url'=>['internacion/changeSala','i_id'=>$i_id], 'label'=>'Cambiar salas'],
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuCirugia($params = [], $selected = ['','']){
        $cirugia = null;$menu = [];
        if(isset($params['c_id'])){
            $cirugia = Cirugia::model()->findByPk($params['c_id']);
        }

        if($cirugia){
            if($cirugia->reservado){
                $menu = [
                    'itemCirugia' => [
                        'label' => 'Cirugia programada',
                        'items' =>[
                            'cirugia_Index' => ['url'=>['cirugia/index'],'label'=>'Calendario'],
                            'cirugia_Ver'=>['url'=>['cirugia/view','c_id'=>$cirugia->id_cir],'label'=>'Detalle'],
                            'cirugia_Registrar'=>['url'=>['cirugia/registrar','c_id'=>$cirugia->id_cir],'label'=>'Confirmar'],
                            'cirugia_Programar'=>['url'=>['cirugia/programar','c_id'=>$cirugia->id_cir],'label'=>'Reprogramar'],
                            'cirugia_Cancelar'=>['url'=>['cirugia/cancelar','c_id'=>$cirugia->id_cir],'label'=>'Cancelar']
                        ]
                    ]
                ];
            }
            else{
                $menu = [
                    'itemCirugia' => [
                        'label' => 'Cirugia registrada',
                        'items' =>[
                            'cirugia_Index' => ['url'=>['cirugia/index'],'label'=>'Calendario'],
                            'cirugia_Ver'=>['url'=>['cirugia/view','c_id'=>$cirugia->id_cir],'label'=>'Detalle'],
                            'cirugia_Registrar'=>['url'=>['cirugia/registrar','c_id'=>$cirugia->id_cir],'label'=>'Editar']
                        ]
                    ]
                ];
            }
        }
        else{
            $menu =[
                'cirugias' => [
                    'label' => 'Cirugias',
                    'items' =>[
                        'cirugia_Index' => ['url'=>['cirugia/index'],'label'=>'Calendario'],
                        'cirugia_Programar' => ['url'=>['cirugia/programar'],'label'=>'Programar'],
                        'cirugia_Registrar' => ['url'=>['cirugia/registrar'],'label'=>'Registrar']
                    ]
                ]
            ];
        }
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuDiagnostico($params = [], $selected = ['','']){
        $dModel = Diagnostico::model()->findByPk($params['d_id']);
        $menu = [
            'historial'=>[
                'label'=>'Historial',
                'items'=>[
                    'indexHistorial'=>['url'=>['historialMedico/index','id_paciente'=>$dModel->id_historial],'label'=>'Indice'],
                    'diagnostico_Crear'=>['url'=>['diagnostico/create','h_id'=>$dModel->id_historial],'label'=>'Nuevo Diagnostico'],
                ]
            ],
            'diagnostico'=>[
                'label'=>'diagnostico',
                'items'=>[
                    'diagnostico_Ver'=>['url'=>['diagnostico/view','d_id'=>$dModel->id_diag],'label'=>'Detalle'],
                    'evolucion_Crear'=>['url'=>['evolucion/create','d_id'=>$dModel->id_diag],'label'=>'Agregar Evolucion'],
                    'tratamiento_Index'=>['url'=>['tratamiento/index','d_id'=>$dModel->id_diag],'label'=>'Tratamientos realizados'],
                    'tratamiento_Create'=>['url'=>['tratamiento/create','d_id'=>$dModel->id_diag],'label'=>'Agregar Tratamiento']
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuExamen($params = [],$selected = ['','']){
        $menu = [
            'examen'=>[
                'label' => 'Examenes laboratorio',
                'items' => [
                    'examen_Index' => ['url'=>['examen/index'],'label'=>'Pendientes'],
                    'examen_List' => ['url'=>['examen/list'],'label'=>'Realizados'],
                    'examen_Examen' => ['url'=>['examen/examen'],'label'=>'Adm. de examenes']
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuAuthenticacion($params = [], $selected = ['', ''])
    {//USER: paso 3-definir menu como en el ejemplo, tomar nota de los items
        $menu = [
            'Roles' => [
                'label' => 'Roles de Acceso al Sistema',
                'items' => [
                    'authentication_AdminRoles' => ['url' => ['authentication/adminRoles'], 'label' => 'Administrar Roles'],
                    'authentication_CreateRole' => ['url' => ['authentication/CreateRole'], 'label' => 'Crear Rol'],
                    'authentication_AdminTasks' => ['url' => ['authentication/adminTasks'], 'label' => 'Administrar Tareas'],
                    'authentication_CreateTask' => ['url' => ['authentication/createTask'], 'label' => 'Crear Tarea'],
                    'authentication_ViewOperations' => ['url' => ['examen/parametros'], 'label' => 'Ver Operaciones']
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }

    public static function menuUsuario($params = [], $selected = ['', ''])
    {
        $menu = [
            'Usuarios' => [
                'label' => 'Usuarios del Sistema',
                'items' => [
                    'Pagina de Inicio de Usuario' => ['url' => ['authentication/adminRoles'], 'label' => 'Administrar Roles'],
                    'usuario_Create' => ['url' => ['authentication/CreateRole'], 'label' => 'Adm. de examenes'],
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu, $selected);
    }
    
    public static function menuReporteCirugia($params = [],$selected = ['','']){
        $menu = [
            'cirugia'=>[
                'label'=>'Reportes de cirugia',
                'items'=>[
                    'reporteCirugia_Index'=>['url'=>['reporteCirugia/index'], 'label'=>'Realizados'],
                    'reporteCirugia_Index2'=>['url'=>['reporteCirugia/index2'], 'label'=>'Reservados'],
                    'reporteCirugia_EstadisticaSala'=>['url'=>['reporteCirugia/estadisticaSala'],'label'=>'Uso de quirofanos'],
                    'reporteCirugia_EstadisticaPersonal' => ['url'=>['reporteCirugia/estadisticaPersonal'],'label'=>'Personal']
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuReporteInternacion($params = [],$selected = ['','']){
        $menu = [
          'internacion'=>[
              'label'=>'Reportes de internacion',
              'items'=>[
                  'reporteInternacion_Index'=>['url'=>['reporteInternacion/index'],'label'=>'Internaciones'],
                  'reporteInternacion_Graficas'=>['url'=>['reporteInternacion/graficas'],'label'=>'Graficas']
              ]
          ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuReporteLaboratorio($params = [],$selected = ['','']){
        $menu = [
            'lab'=>[
                'label'=>'Reportes de laboratorio',
                'items'=>[
                    'reporteLaboratorio_Index'=>['url'=>['reporteLaboratorio/index'],'label'=>'Examenes de laboratorio'],
                    'reporteLaboratorio_Examenes'=>['url'=>['reporteLaboratorio/examenes'],'label'=>'Examenes mas realizados']
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }

    public static function menuEspecialOptions($params = [], $selected = ['','']){
        $menu =[
            'vademecum' =>[
                'label'=>'Vademecum',
                'items'=>[
                    'medicamento_Index'=>['url'=>['medicamento/index'],'label'=>'Listado']
                ]
            ],
            'cie'=>[
                'label'=>'CIE10',
                'items'=>[
                    'cie_Index'=>['url'=>['cie/index'],'label'=>'Listado']
                ]
            ],
            'parametros'=>[
                'label'=>'Parametros',
                'items'=>[
                    'parametro_Index'=>['url'=>['parametro/index'],'label'=>'Listado'],
                    'parametro_Create'=>['url'=>['parametro/create'],'label'=>'Nuevo P.']
                ]
            ]
        ];
        $menu = self::verAcceso($menu);
        return self::selectMenu($menu,$selected);
    }
    private static function selectMenu($menu = [], $selected = ['','']){
        $submenu = [];
        if(count($selected)==2){
            if(array_key_exists($selected[0], $menu)){
                $submenu = $menu[ $selected[0] ]['items'];
                if(array_key_exists($selected[1], $submenu)){
                    $menu[ $selected[0] ]['items'][ $selected[1] ]['selected'] = true;
                }
            }
        }
        return $menu;
    }

    public static function verAcceso($menu)
    {
        foreach ($menu as $i => $item) {
            foreach ($item['items'] as $index => $link) {
                if (!(Yii::app()->authManager->checkAccess($index, Yii::app()->user->id)))
                    unset($menu[$i]['items'][$index]);
            }
        }
        return $menu;
    }

}