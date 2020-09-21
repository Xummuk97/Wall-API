<?php

namespace application\core;

use application\core\View;

abstract class Controller
{

    protected $route;
    protected $model;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view  = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $model_path = 'application\models\\' . ucfirst($name);

        if (class_exists($model_path)) {
            return new $model_path;
        }
    }

    public function headerAPI()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }
    
    public function hasErrorsFields($arr)
    {
        if (!empty($arr))
        {
            # Выводим ответ в виде ошибки, в котором указываем какое поле не заполнено
             echo json_encode([ 
                'Errors' => [
                    'Fields' => $arr,
                ] 
            ], JSON_UNESCAPED_UNICODE);
                
            return true;
        }
        return false;
    }
    
    public function errorGlobal($error)
    {
        # Выводим ответ в виде ошибки
        echo json_encode([ 
            'Errors' => [
                'Global' => $error,
            ] 
        ], JSON_UNESCAPED_UNICODE);
    }
}
