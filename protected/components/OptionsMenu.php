<?php
class OptionsMenu{

    public static function menuPaciente($params = [], $selected = ['','']){
        $menu = [
            'pacientes'=>[
                'label'=>'<i class="fa fa-group"></i> Pacientes',
                'items'=>[
                    'index'=>['url'=>['paciente/index'],'label'=>'<i class="fa fa-th-list"></i> Lista'],
                    'create'=>['url'=>['paciente/create'],'label'=>'<i class="fa fa-plus"></i> Nuevo Paciente']
                ]
            ]
        ];
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

}