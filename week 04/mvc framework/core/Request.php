<?php

namespace app\core;

class Request
{


    public function setEndPoint()
    {
        $arrOfpaths = explode('/',$this->getPath());
        if ($this->hasEndpoint()){
             Application::$app->controller->endPointParameter=$arrOfpaths[count($arrOfpaths)-1];
        }else{
            Application::$app->controller->endPointParameter='';
        }
    }

    public function hasEndpoint(): bool
    {
        $arrOfpaths = explode('/',$this->getPath());

        if (substr_count($this->getPath(),'/')===1){
            if (!empty($arrOfpaths[1])){
                if (!in_array($arrOfpaths[1],Application::$app->router->getAllPath())){
                    return false;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
    public function getPath()
    {
        $path=$_SERVER['REQUEST_URI']??'/';
        $position = strpos($path, '?');
        if ($position===false){
            return $path;
        }
        $path=substr($path, 0, $position);
        return $path;

    }
    public function method(){
        return strtolower($_SERVER['REQUEST_METHOD']);

    }
    public function isGet(){
        return $this->method()==='get';

    }
    public function isPost(){
        return $this->method()==='post';
    }
    public function getBody()
    {
        $body=[];
        if ($this->method()==='get'){
            foreach ($_GET as $key=>$value){
                $body[$key]=filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method()==='post'){
            foreach ($_POST as $key=>$value){
                $body[$key]=filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}