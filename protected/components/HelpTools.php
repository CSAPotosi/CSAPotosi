<?php
class HelpTools{
    public static function appendToBaseNumber($n = '', $base = 2, $cant = 0){
        $tempN = self::baseToDec($n, $base) + $cant;
        return self::decToBase($tempN, $base);
    }

    public static function charToInt($c){
        if($c>='0'&&$c<='9')
            return $c + 0;
        if($c>='A'&&$c<='Z')
            return 10 + (ord($c)-65);
    }

    public static function intToChar($i){
        if($i>=0 &&$i<=9)
            return $i;
        $i-=10;
        return chr($i+65);
    }

    public static function decToBase($number = 0, $base = 2){
        $tempN = '';
        while($number > 0){
            $tempN = self::intToChar($number%$base).$tempN;
            $number = floor($number/$base);
        }
        return $tempN;
    }

    public static function baseToDec($number = '0', $base = 2){
        $res = 0;
        for($i = strlen($number) - 1,$pow = 1; $i>=0 ; $i--,$pow*=$base){
            $res += (self::charToInt($number[$i])*$pow);
        }
        return $res;
    }

    public static function getDate($date = null){
        $date_formats = ['Y-m-d','Y-m-d H:i','Y-m-d H:i:s','d/m/Y','d/m/Y H:i','d/m/Y H:i:s'];
        $new_date = new DateTime();
        foreach($date_formats as $format){
            $temp_date = DateTime::createFromFormat($format, $date);
            if($temp_date){
                return $temp_date;
            }
        }
        return $new_date;
    }

    public static function checkAccess($operatios = []){
        foreach ($operatios as $oper){
            if(Yii::app()->user->checkAccess($oper))
                return true;
        }
        return false;
    }
}