<?php

namespace application\libs;

class Utils
{
    static public function strToSecs($str)
    {
        # Минуты
        if (strpos($str, 'm') === true)
        {
            str_replace("m", "", $str);
            return intval($str) * 60;
        }
        # Часы
        else if (strpos($str, 'h') === true)
        {
            str_replace("m", "", $str);
            return intval($str) * 3600;
        }
        
        # Дни
        str_replace("m", "", $str);
        return intval($str) * 86400;
    }
    
    static public function deleteStrTASK(&$str)
    {
        $str = str_replace("TASK-", "", $str);
    }
}