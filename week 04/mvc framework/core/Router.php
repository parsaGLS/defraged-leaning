<?php
namespace app\core;
use app\core\exception\ForbiddenException;
use app\core\exception\NotFoundException;

class Router
{
    public Response $response;
    protected array $routes = [];
    public Request $request;

    /**
     * @param Request $request
     */
    public function __construct( Request $request,Response $response )
    {
        $this->response=$response;
        $this->request = $request;
    }
    public function getAllPath()
    {
        $result=[];
        foreach($this->routes['get'] as $key => $route){
            if ($key==='/'){
                continue;
            }

            $result[]=substr($key,1);
        }
        return $result;
    }

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path=$this->request->getPath();
        if (Application::$app->request->hasEndpoint()){
                $path='/'.explode('/',$path)[1];
        }
        $method=$this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback===false){
            if (!Application::$app->request->hasEndpoint()){
                throw new NotFoundException();
            }
        }
        if (is_string($callback)){
            return Application::$app->view->renderView($callback);
        }
        if (is_array($callback)){
            /** @var Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller=$controller ;
            $controller->action=$callback[1];
            $calback[0]= $controller;
            foreach ($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }
        Application::$app->request->setEndPoint();
        return call_user_func($callback , $this->request,$this->response);

    }




}