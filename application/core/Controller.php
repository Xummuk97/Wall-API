<?php

namespace application\core;

use application\core\View;

abstract class Controller
{

    protected $route;
    protected $models = [];
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view  = new View($route);
        $this->onCreate();
    }

    abstract public function onCreate();

    public function loadModels($models)
    {
        foreach ($models as $model)
        {
            $this->loadModel($model);
        }
    }
    
    public function loadModel($name)
    {
        $model_path = 'application\models\\' . ucfirst($name);

        if (class_exists($model_path)) {
            $this->models[$name] = new $model_path;
        }
    }

    public function headerAPI()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }
    
    public function sendErrors($errors)
    {
        if (!empty($errors))
        {
            # Выводим ответ в виде ошибки, в котором указываем какое поле не заполнено
             echo json_encode([ 
                'Errors' => $errors,
            ], JSON_UNESCAPED_UNICODE);
                
            return true;
        }
        return false;
    }
    
    public function sendResponse($response)
    {
        # Выводим ответ
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}
