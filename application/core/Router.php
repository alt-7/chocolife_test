<?php
/**
 * Created by PhpStorm.
 * User: altosh
 * Date: 5/24/18
 * Time: 12:47 PM
 */

namespace application\core;

use application\core\View;

class Router {

    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $value){
            $route = '#^'.$key.'$#';
            $this->routes[$route] = $value;

        }
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'],'/');
        foreach ($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if($this->match()) {
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if(class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                }else {
                    echo '404';
                }
            }else {
                echo '404';
            }
        }else {
            echo '403';
        }
    }
}