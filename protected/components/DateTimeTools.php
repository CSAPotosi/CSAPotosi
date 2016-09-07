<?php
class DateTimeTools extends CApplicationComponent{

    public function convertTimeToMinutes($time = '00:00'){
        $min = date('G',strtotime($time))*60;
        $min += date('i',strtotime($time));
        return $min;
    }
}