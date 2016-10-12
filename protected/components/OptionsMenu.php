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
                    'alta'=>['url'=>['internacion/alta','i_id'=>$i_id],'label'=>'Alta'],
                    'changeSala'=>['url'=>['internacion/changeSala','i_id'=>$i_id], 'label'=>'Cambiar salas'],
                ]
            ]
        ];
        return self::selectMenu($menu,$selected);
    }

    public static function menuDiagnostico($params = [], $selected = ['','']){
        $menu = [
            'historial'=>[
                'label'=>'Historial',
                'items'=>[
                    'indexHistorial'=>['url'=>[],'label'=>'Indice'],
                    'newHistorial'=>['url'=>[],'label'=>'Nuevo'],
                ]
            ],
            'Diagnostico'=>[
                'label'=>'diagnostico',
                'items'=>[
                    'indexDiagnostico'=>['url'=>[],'label'=>'Detalle'],
                    'addTratamiento'=>['url'=>[],'label'=>'Agregar Tratamiento'],
                    'addEvolucion'=>['url'=>[],'label'=>'Agregar Evolucion']
                ]
            ]
        ];
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