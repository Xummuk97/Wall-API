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
            
            'user/login' => [
                'controller' => 'user',
                'action' => 'login'
            ],
            
            'user/logout' => [
                'controller' => 'user',
                'action' => 'logout'
            ],
            
            'message/add' => [
                'controller' => 'message',
                'action' => 'add'
            ],
            
            'messages' => [
                'controller' => 'message',
                'action' => 'get'
            ],
            
            'message/delete' => [
                'controller' => 'message',
                'action' => 'delete'
            ],
        ];
    }

}
