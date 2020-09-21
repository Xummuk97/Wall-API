<?php

namespace application\controllers;

use application\core\Controller;
use application\libs\Valid;
use application\controllers\UserController;

class MessageController extends Controller 
{
    public function onCreate()
    {
        $this->loadModels([ 'Message' ]);
    }
    
    public function check()
    {
        if (!UserController::has())
        {
            $this->sendError('Пожалуйста, войдите в аккаунт!');
            return false;
        }
        return true;
    }
    
    public function addAction()
    {
        $this->headerAPI();
        
        if (!$this->check())
        {
            return;
        }
        
        $text = Valid::normalStrFromPOST('text');
        
        if (empty($text))
        {
            $this->sendError('Поле "Текст" не заполнено!');
            return;
        }
        
        $createtime = time();
        $insert_id = $this->models['Message']->add($text, $createtime);
        
        $response = [
            'id' => $insert_id, 
            'createtime' => date('Y.m.d H:i:s', $createtime)
        ];
        
        $this->sendResponse($response);
    }
    
    public function getAction()
    {
        $this->headerAPI();
        
        if (!$this->check())
        {
            return;
        }
        
        $limit = Valid::normalStrFromPOST('limit');
        $offset = Valid::normalStrFromPOST('offset');
        
        $errors = [];
        
        if (empty($limit))
        {
            $errors[] = 'Поле "Лимит сообщений" не заполнено!';
        }
        
        if (empty($offset) && $offset != 0)
        {
            $errors[] = 'Поле "Сдвиг сообщений" не заполнено!';
        }
        
        if ($this->sendErrors($errors))
        {
            return;
        }
        
        $messages = $this->models['Message']->getMessages($limit, $offset);
        $this->sendResponse($messages);
    }
    
    public function deleteAction()
    {
        $this->headerAPI();
        
        if (!$this->check())
        {
            return;
        }
        
        $id = Valid::normalStrFromPOST('id');
        
        if (empty($id))
        {
            $this->sendError('Поле "Идентификатор сообщения" не заполнено!');
            return;
        }
        
        if (!$this->models['Message']->has($id))  
        {
            $this->sendError('Сообщение с таким идентификатором не существует!');
            return;
        }
        
        $message = $this->models['Message']->getMessage($id);
        
        if ($message['email'] != $_SESSION['user']['email'])
        {
            $this->sendError('Невозможно удалить сообщение другого юзера!');
            return;
        }
        
        $deltatime = time() - $message['createtime'];
        
        if ($deltatime < 86400)
        {
            $this->sendError('Невозможно удалить сообщение, которое создано менее суток назад!');
            return;
        }
        
        $this->models['Message']->delete($id);
    }
}