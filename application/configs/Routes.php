<?php

namespace application\configs;

class Routes
{

    public static function getRoutes()
    {
        return [
            'user/register' => [
                'controller' => 'user',
                'action' => 'register'
            ],
        ];
    }

}
