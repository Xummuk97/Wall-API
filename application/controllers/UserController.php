<?php

namespace application\controllers;

use application\core\Controller;
use application\libs\Valid;

class UserController extends Controller 
{
    public function onCreate()
    {
        $this->loadModels([ 'User' ]);
    }
    
    public function registerAction()
    {
        $this->headerAPI();
        
        if (UserController::has())
        {
            $this->sendError('Пожалуйста, выйдите из аккаунта!');
            return;
        }
        
        $errors = [];
        
        $name = Valid::normalStrFromPOST('name');
        $email = Valid::normalStrFromPOST('email');
        $password = Valid::normalStrFromPOST('password');
        
        if (empty($name))
        {
            $errors[] = 'Поле "Имя" не заполнено!';
        }
        
        if (empty($email))
        {
            $errors[] = 'Поле "E-Mail" не заполнено!';
        }
        
        if (empty($password))
        {
            $errors[] = 'Поле "Пароль" не заполнено!';
        }
        
        if ($this->sendErrors($errors))
        {
            return;
        }
        
        if ($this->models['User']->has($email))
        {
            $this->sendError('Такой пользователь уже существует!');
            return;
        }
        
        $this->models['User']->add($name, $email, password_hash($password, PASSWORD_BCRYPT));
    }
    
    public function loginAction()
    {
        $this->headerAPI();
        
        $errors = [];
        
        $email = Valid::normalStrFromPOST('email');
        $password = Valid::normalStrFromPOST('password');
        
        if (empty($email))
        {
            $errors[] = 'Поле "E-Mail" не заполнено!';
        }
        
        if (empty($password))
        {
            $errors[] = 'Поле "Пароль" не заполнено!';
        }
        
        if ($this->sendErrors($errors))
        {
            return;
        }
        
        if (!$this->models['User']->has($email))
        {
            $this->sendError('Такого пользователя не существует!');
            return;
        }
        
        $user = $this->models['User']->get($email);
        
        if (password_verify($password, $user['password']))
        {
            $_SESSION['user'] = $user;
        }
        else
        {
            $this->sendError('Пароль не верный!');
        }
    }
    
    public function logoutAction()
    {
        unset($_SESSION['user']);
    }
    
    static public function has()
    {
        return isset($_SESSION['user']);
    }
}