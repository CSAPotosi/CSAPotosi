<?php
class OptionsMenu{

    public static function menuPaciente($params = [], $selected = ['','']){
        $menu = [
            'pacientes'=>[
                'label'=>'<i class="fa fa-group"></i> Pacientes',
                'items'=>[
                    'Lista Paciente' => ['url' => ['paciente/index'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                    'Crear Paciente' => ['url' => ['paciente/create'], 'label' => '<i class="fa fa-plus"></i> Nuevo Paciente']

                ]
            ]
        ];
        if (isset($params['id_paciente'])) {
            $paciente = Paciente::model()->findByPk($params['id_paciente']);
            $menu2 = [
                'label' => '<i class="fa fa-user"></i>' . $paciente->persona->getNombreCompleto(),
                'items' => [
                    'Detalle Paciente' => ['url' => ['paciente/detallePaciente', 'id' => $params['id_paciente']], 'label' => 'Detalle Paciente'],
                    'Actualizar Paciente' => ['url' => ['paciente/update', 'id' => $params['id_paciente']], 'label' => 'Actualizar Paciente'],
                    'Prestacion Servicios' => ['url' => ['HistorialMedico/externoCreate', 'id' => $params['id_paciente']], 'label' => 'Solicitud de Servicios'],
                    'Seguro Paciente' => ['url' => ['paciente/seguroPaciente', 'id' => $params['id_paciente']], 'label' => 'Seguro de Paciente'],
                    'Seguro Create' => ['url' => ['paciente/seguroCreate', 'id' => $params['id_paciente']], 'label' => 'Asegurar Paciente'],
                    'Cita' => ['url' => ['cita/indexCita', 'id' => $params['id_paciente']], 'label' => 'Dar Cita']
                ]
            ];
            $menu['paciente'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }

    public static function menuEmpleado($params = [], $selected = ['', ''])
    {
        $menu = [
            'empleados' => [
                'label' => '<i class="fa fa-suitcase"></i></i> Empleados',
                'items' => [
                    'Lista Empleado' => ['url' => ['empleado/index'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                    'Crear Empleado' => ['url' => ['empleado/Create'], 'label' => '<i class="fa fa-plus"></i> Nuevo Empleado']

                ]
            ]
        ];
        if (isset($params['id_empleado'])) {
            $empleado = Empleado::model()->findByPk($params['id_empleado']);
            $menu2 = [
                'label' => '<i class="fa fa-user"></i>' . $empleado->empleadoPersona->getNombreCompleto(),
                'items' => [
                    'Detalle Empleado' => ['url' => ['empleado/detalleEmpleado', 'id' => $params['id_empleado']], 'label' => 'Detalle Empleado'],
                    'Actualizar Empleado' => ['url' => ['empleado/update', 'id' => $params['id_empleado']], 'label' => 'Actualizar Empleado'],
                ]
            ];
            $menu['empleado'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }

    public static function menuMedico($params = [], $selected = ['', ''])
    {
        $menu = [
            'medicos' => [
                'label' => '<i class="fa fa-medkit"></i></i> Medicos',
                'items' => [
                    'Lista Medicos' => ['url' => ['medico/index'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                    'Crear Medicos' => ['url' => ['medico/Create'], 'label' => '<i class="fa fa-plus"></i> Nuevo Medico']

                ]
            ]
        ];
        if (isset($params['id_medico'])) {
            $medico = Medico::model()->findByPk($params['id_medico']);
            $menu2 = [
                'label' => '<i class="fa fa-user"></i>' . $medico->persona->getNombreCompleto(),
                'items' => [
                    'Detalle Medicos' => ['url' => ['medico/detalleMedico', 'id' => $params['id_medico']], 'label' => 'Detalle Medico'],
                    'Actualizar Medico' => ['url' => ['medico/update', 'id' => $params['id_medico']], 'label' => 'Actualizar Medico'],
                ]
            ];
            $menu['medico'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }

    public static function menuUnidad($params = [], $selected = ['', ''])
    {
        $menu = [
            'unidades' => [
                'label' => '<i class=""></i></i> Unidades',
                'items' => [
                    'Lista Unidad' => ['url' => ['unidad/index'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                    'Crear Unidad' => ['url' => ['unidad/Create'], 'label' => '<i class="fa fa-plus"></i> Nueva Unidad']

                ]
            ]
        ];
        if (isset($params['id_unidad'])) {
            $unidad = Unidad::model()->findByPk($params['id_unidad']);
            $menu2 = [
                'label' => '<i class=""></i>' . $unidad->nombre_unidad,
                'items' => [
                    'Actualizar Unidad' => ['url' => ['unidad/update', 'id' => $params['id_unidad']], 'label' => 'Editar Unidad'],
                    'Lista Cargos' => ['url' => ['cargo/index', 'id' => $params['id_unidad']], 'label' => 'Cragos de Unidad'],
                    'Crear Cargo' => ['url' => ['cargo/create', 'id' => $params['id_unidad']], 'label' => 'Nuevo Cargo'],
                ]
            ];
            $menu['unidad'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }
    public static function menuConvenio($params = [], $selected = ['', ''])
    {
        $menu = [
            'convenios' => [
                'label' => '<i class="fa fa-archive"></i></i> Convenios',
                'items' => [
                    'Lista Convenio' => ['url' => ['convenio/indexConvenio'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                ]
            ]
        ];
        if (isset($params['id_convenio'])) {
            $convenio = Convenio::model()->findByPk($params['id_convenio']);
            $menu2 = [
                'label' => '<i class=""></i>' . $convenio->nombre_convenio,
                'items' => [
                    'Convenio Servicio' => ['url' => ['convenio/indexServicioConvenio', 'id' => $params['id_convenio']], 'label' => 'detalle'],
                ]
            ];
            $menu['convenio'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }

    public static function menuAsignacion($params = [], $selected = ['', ''])
    {
        $menu = [
            'asignaciones' => [
                'label' => '<i class=""></i></i> Asignaciones',
                'items' => [
                    'Lista Asignacion' => ['url' => ['AsignacionEmpleado/index'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                    'Crear Asignacion' => ['url' => ['AsignacionEmpleado/Create'], 'label' => '<i class="fa fa-plus"></i> Nueva Asignacion'],

                ]
            ]
        ];
        $menu3 = [
            'label' => '<i class=""></i>Asistencia',
            'items' => [
                'Cargar Asistencia' => ['url' => ['Registro/subir'], 'label' => '<i class=""></i> Cargar Asistencia'],
                'Crear Registro' => ['url' => ['Registro/Create'], 'label' => '<i class=""></i> Registro manual'],
                'Registro Automatico' => ['url' => ['Registro/registroManual'], 'label' => '<i class=""></i> Registro Automomatico'],
                'Informacion Asistencia' => ['url' => ['Registro/reportAsistencia'], 'label' => '<i class=""></i> Informacion de Asistencia'],
            ]
        ];
        $menu['asistencia'] = $menu3;
        if (isset($params['id_asignacion'])) {
            $asignacion = AsignacionEmpleado::model()->findByPk($params['id_asignacion']);
            $menu2 = [
                'label' => '<i class=""></i>' . $asignacion->empleado->empleadoPersona->getNombreCompleto(),
                'items' => [
                    'Actualizar Asignacion' => ['url' => ['AsignacionEmpleado/update', 'id' => $params['id_asignacion']], 'label' => 'Editar Asignacion'],
                ]
            ];
            $menu['asignacion'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }

    public static function menuHorario($params = [], $selected = ['', ''])
    {
        $menu = [
            'horarios' => [
                'label' => '<i class="fa fa-clock-o"></i></i> Horarios',
                'items' => [
                    'Lista Horario' => ['url' => ['horario/index'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                    'Crear Horario' => ['url' => ['horario/Create'], 'label' => '<i class="fa fa-plus"></i> Nuevo Horario']
                ]
            ]
        ];
        if (isset($params['id_horario'])) {
            $horario = Horario::model()->findByPk($params['id_horario']);
            $menu2 = [
                'label' => '<i class=""></i>' . $horario->nombre_horario,
                'items' => [
                    'Actualizar Horario' => ['url' => ['horario/update', 'id' => $params['id_horario']], 'label' => 'Editar'],
                    'Crear Periodo' => ['url' => ['horario/createPeriodo', 'id' => $params['id_horario']], 'label' => 'Pediodos'],
                ]
            ];
            $menu['horario'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }
    public static function menuHistorial($params = [], $selected = ['','']){
        $menu = [
            'historial'=>[
                'label'=>'<i class="fa fa-files-o"></i>Historial',
                'items'=>[
                    'indexHistorial'=>['url'=>['historialMedico/index','id_paciente'=>$params['h_id']], 'label'=>'<i class="fa fa-files-o"></i>Historial'],
                    'newDiagnostico'=>['url'=>['diagnostico/create','h_id'=>$params['h_id']],'label'=>'<i class="fa fa-stethoscope"></i>Nuevo diagnostico']
                ]
            ]
        ];

        if(isset($params['h_id'])){
            $hisTemp = HistorialMedico::model()->findByPk($params['h_id']);
            $interModel = $hisTemp->internacionActual;
            if($interModel)
                $menu['historial']['items']['internacion'] = ['url'=>['internacion/index','i_id'=>$interModel->id_inter],'label'=>'Ver internacion actual'];
            else
                $menu['historial']['items']['internacion'] = ['url'=>['internacion/createIngreso', 'h_id'=>$params['h_id']], 'label'=>'<i class="fa fa-ambulance"></i>Internar paciente'];
        }
        return self::selectMenu($menu,$selected);
    }

    public static function menuSalas($params=[],$selected = ['','']){
        $menu = [
            'tipoSala'=>[
                'label'=>'Tipos de salas',
                'items'=>[
                    'indexTSala'=>['url'=>['servicio/index','grupo'=>'sala'],'label'=>'Lista'],
                    'newTSala'=>['url'=>['servicio/create','grupo'=>'sala'],'label'=>'Nuevo']
                ]
            ]
        ];
        if(isset($params['ts_id'])){
            $tsModel = ServTipoSala::model()->findByPk($params['ts_id']);
            if($tsModel != null){
                $menu2 = [
                    'label'=>$tsModel->servicio->nombre_serv,
                    'items'=>[
                        'viewTSala'=>['url'=>['servicio/view','grupo'=>'sala','id'=>$tsModel->id_serv], 'label'=>'Detalle'],
                        'editTSala'=>['url'=>['servicio/update','grupo'=>'sala','id'=>$tsModel->id_serv], 'label'=>'Editar']
                    ]
                ];
                $menu['itemTSala']=$menu2;
            }
        }
        return self::selectMenu($menu,$selected);
    }

    public static function menuExamenLab($params = [], $selected = ['', ''])
    {
        if ($params['tipo'] == 1) {
            $menu = [
                'examenLab' => [
                    'label' => '<i class="fa fa-flask"></i></i> Exa. de Laboratorio',
                    'items' => [
                        'Lista ExamenLab' => ['url' => ['servicio/index', 'grupo' => 'examen', 'tipo' => '1'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                        'Crear ExamenLab' => ['url' => ['servicio/create', 'grupo' => 'examen', 'tipo' => '1'], 'label' => '<i class="fa fa-plus"></i> Examen de laboratorio'],
                        'Categorias Laboratorio' => ['url' => ['CategoriaServicio/index', 'grupo' => 'examen', 'tipo' => '1'], 'label' => '<i class="fa fa-cog"></i> Categorias']
                    ]
                ]
            ];
        }
        if ($params['tipo'] == 2) {
            $menu = [
                'examenLab' => [
                    'label' => '<i class="fa fa-image"></i></i> Exa. de Rayos X',
                    'items' => [
                        'Lista ExamenLab' => ['url' => ['servicio/index', 'grupo' => 'examen', 'tipo' => '2'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                        'Crear ExamenLab' => ['url' => ['servicio/create', 'grupo' => 'examen', 'tipo' => '2'], 'label' => '<i class="fa fa-plus"></i> Examen de Rayos x'],
                        'Categorias Laboratorio' => ['url' => ['CategoriaServicio/index', 'grupo' => 'examen', 'tipo' => '2'], 'label' => '<i class="fa fa-cog"></i> Categorias']
                    ]
                ]
            ];
        }
        if ($params['tipo'] == 3) {
            $menu = [
                'examenLab' => [
                    'label' => '<i class="fa fa-image"></i></i> Servicios Clinicos',
                    'items' => [
                        'Lista ExamenLab' => ['url' => ['servicio/index', 'grupo' => 'clinico', 'tipo' => '3'], 'label' => '<i class="fa fa-th-list"></i> Lista'],
                        'Crear ExamenLab' => ['url' => ['servicio/create', 'grupo' => 'clinico', 'tipo' => '3'], 'label' => '<i class="fa fa-plus"></i> Servicio Clinico'],
                        'Categorias Laboratorio' => ['url' => ['CategoriaServicio/index', 'grupo' => 'clinico', 'tipo' => '3'], 'label' => '<i class="fa fa-cog"></i> Categorias']
                    ]
                ]
            ];
        }
        if (isset($params['id_servicio'])) {
            $servicio = ServExamen::model()->findByPk($params['id_servicio']);
            $menu2 = [
                'label' => '<i class=""></i>' . $servicio->datosServicio->nombre_serv,
                'items' => [
                    'Actualizar' => ['url' => ['servicio/update', 'id' => $params['id_servicio']], 'label' => 'update'],
                ]
            ];
            $menu['examenLabs'] = $menu2;
        }
        return self::selectMenu($menu, $selected);
    }

    public static function menuAtencionMedica($params = [], $selected = ['', ''])
    {
        $menu = [
            'atenciones' => [
                'label' => 'Atenciones Medicas',
                'items' => [
                    'index' => ['url' => ['servicio/atencionMedicaIndex', 'grupo' => 'sala', 'tipo' => '4'], 'label' => 'Lista'],
                ]
            ]
        ];
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
                    'newDiagnostico'=>['url'=>['diagnostico/create','h_id'=>$h_id],'label'=>'<i class="fa fa-stethoscope"></i>Nuevo diagnostico']
                ]
            ],
            'internacion'=>[
                'label'=>'Internacion',
                'items'=>[
                    'index'=>['url'=>['internacion/index','i_id'=>$i_id], 'label'=>'Indice'],
                    'listServicio'=>['url'=>['prestacionServicios/indexForInter','i_id'=>$i_id],'label'=>'Servicios prestados'],
                    'addServicio'=>['url'=>['prestacionServicios/createForInter','i_id'=>$i_id], 'label'=>'Agregar servicios'],
                    'alta'=>['url'=>['internacion/alta','i_id'=>$i_id],'label'=>'Alta'],
                    'notasEnfermeria'=>['url'=>['notaEnfermeria/index','i_id'=>$i_id],'label'=>'Notas de enfermeria'],
                    'changeSala'=>['url'=>['internacion/changeSala','i_id'=>$i_id], 'label'=>'Cambiar salas'],
                ]
            ]
        ];
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
                            'index' => ['url'=>['cirugia/index'],'label'=>'Calendario'],
                            'view'=>['url'=>['cirugia/view','c_id'=>$cirugia->id_cir],'label'=>'Detalle'],
                            'confirmar'=>['url'=>['cirugia/registrar','c_id'=>$cirugia->id_cir],'label'=>'Confirmar'],
                            'reprogramar'=>['url'=>['cirugia/programar','c_id'=>$cirugia->id_cir],'label'=>'Reprogramar'],
                            'cancelar'=>['url'=>['cirugia/cancelar','c_id'=>$cirugia->id_cir],'label'=>'Cancelar']
                        ]
                    ]
                ];
            }
            else{
                $menu = [
                    'itemCirugia' => [
                        'label' => 'Cirugia registrada',
                        'items' =>[
                            'index' => ['url'=>['cirugia/index'],'label'=>'Calendario'],
                            'view'=>['url'=>['cirugia/view','c_id'=>$cirugia->id_cir],'label'=>'Detalle'],
                            'confirmar'=>['url'=>['cirugia/registrar','c_id'=>$cirugia->id_cir],'label'=>'Editar']
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
                        'index' => ['url'=>['cirugia/index'],'label'=>'Calendario'],
                        'programar' => ['url'=>['cirugia/programar'],'label'=>'Programar'],
                        'registrar' => ['url'=>['cirugia/registrar'],'label'=>'Registrar']
                    ]
                ]
            ];
        }
        return self::selectMenu($menu,$selected);
    }

    public static function menuDiagnostico($params = [], $selected = ['','']){
        $dModel = Diagnostico::model()->findByPk($params['d_id']);
        $menu = [
            'historial'=>[
                'label'=>'Historial',
                'items'=>[
                    'indexHistorial'=>['url'=>['historialMedico/index','id_paciente'=>$dModel->id_historial],'label'=>'Indice'],
                    'newDiagnostico'=>['url'=>['diagnostico/create','h_id'=>$dModel->id_historial],'label'=>'Nuevo Diagnostico'],
                ]
            ],
            'diagnostico'=>[
                'label'=>'diagnostico',
                'items'=>[
                    'view'=>['url'=>['diagnostico/view','d_id'=>$dModel->id_diag],'label'=>'Detalle'],
                    'addEvolucion'=>['url'=>['evolucion/create','d_id'=>$dModel->id_diag],'label'=>'Agregar Evolucion'],
                    'indexTratamiento'=>['url'=>['tratamiento/index','d_id'=>$dModel->id_diag],'label'=>'Tratamientos realizados'],
                    'addTratamiento'=>['url'=>['tratamiento/create','d_id'=>$dModel->id_diag],'label'=>'Agregar Tratamiento']
                ]
            ]
        ];
        return self::selectMenu($menu,$selected);
    }

    public static function menuExamen($params = [],$selected = ['','']){
        $menu = [
            'examen'=>[
                'label' => 'Examenes laboratorio',
                'items' => [
                    'index' => ['url'=>['examen/index'],'label'=>'Pendientes'],
                    'list' => ['url'=>['examen/list'],'label'=>'Realizados'],
                    'examen' => ['url'=>['examen/examen'],'label'=>'Adm. de examenes'],
                    'parametros' => ['url'=>['examen/parametros'],'label'=>'Adm. parametros']
                ]
            ]
        ];

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
                    'index'=>['url'=>['reporteCirugia/index'], 'label'=>'Realizados'],
                    'index2'=>['url'=>['reporteCirugia/index2'], 'label'=>'Reservados'],
                    'estadisticaSala'=>['url'=>['reporteCirugia/estadisticaSala'],'label'=>'Uso de quirofanos'],
                    'estadisticaPersonal' => ['url'=>['reporteCirugia/estadisticaPersonal'],'label'=>'Personal']
                ]
            ]
        ];
        return self::selectMenu($menu,$selected);
    }

    public static function menuReporteInternacion($params = [],$selected = ['','']){
        $menu = [
          'internacion'=>[
              'label'=>'Reportes de internacion',
              'items'=>[
                  'index'=>['url'=>['reporteInternacion/index'],'label'=>'Internaciones'],
                  'grafica'=>['url'=>['reporteInternacion/graficas'],'label'=>'Graficas']
              ]
          ]
        ];
        return self::selectMenu($menu,$selected);
    }

    public static function menuReporteLaboratorio($params = [],$selected = ['','']){
        $menu = [
            'lab'=>[
                'label'=>'Reportes de laboratorio',
                'items'=>[
                    'index'=>['url'=>['reporteLaboratorio/index'],'label'=>'Examenes de laboratorio'],
                    'examenes'=>['url'=>['reporteLaboratorio/examenes'],'label'=>'Examenes mas realizados']
                ]
            ]
        ];
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