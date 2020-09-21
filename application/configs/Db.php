<?php

namespace application\configs;

class Db
{

    public static function getSettings()
    {
        return [
            'host'   => 'localhost',
            'dbname' => 'wall_api',
            'user'   => 'root',
            'pass'   => ''
        ];
    }

}
