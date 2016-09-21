<?php
class OptionsMenu{

    public static function menuPaciente($params = [], $selected = ['','']){
        $menu = [

        ];
        return $menu;
    }

    public static function menuHistorial($params = [], $selected = ['','']){
        $menu = [
            'historial'=>[
                'label'=>'<i class="fa fa-files-o"></i>Historial',
                'items'=>[
                    'indexHistorial'=>['url'=>['historialMedico/index','id_paciente'=>$params['h_id']], 'label'=>'Historial'],
                    'newDiagnostico'=>['url'=>['diagnostico/create','h_id'=>$params['h_id']],'label'=>'<i class="fa fa-plus"></i>Nuevo diagnostico'],
                    'submenu2'=>['url'=>[],'label'=>'submenu']
                ]
            ]
        ];
        return self::selectMenu($menu,$selected);
    }

    public static function menuInternacion($params = [], $selected = ['','']){
        $menu = [
            'servicios'=>[
                'label'=>'servicios',
                'items'=>[
                    'indexServ'=>['url'=>[''],'label']
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