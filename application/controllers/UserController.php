<?php

namespace application\controllers;

use application\core\Controller;

class UserController extends Controller 
{
    public function onCreate()
    {
        $this->loadModels([ 'User' ]);
    }
    
    public function registerAction()
    {
        
    }
}