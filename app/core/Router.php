<?php

namespace App\Core;

use App\Controllers\Errors\HttpErrorController;

class Router{
    public function dispatch($url){
        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];
        
        $controllerName = $parts[0] ?? 'Home';
        $controllerName = 'App\Controllers\\' . ucfirst($controllerName) . 'Controller';

        $actionName = $parts[1] ?? 'index';
        //dd($actionName, $controllerName);
        
        if(!class_exists($controllerName)){
            $controller = new HttpErrorController();
            $controller->NotFound();
            return;
        }
        $controller = new $controllerName();

        if(!method_exists($controller, $actionName)){
            $controller = new HttpErrorController();
            $controller->NotFound();
            return;
        }

        $params = array_slice($parts, 2);

        call_user_func_array([$controller, $actionName], $params);
    }
}