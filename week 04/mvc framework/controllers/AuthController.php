<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\TaskForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }


    public function showTask(Request $request)
    {
        $taskForm=new TaskForm();
        if ($request->isPost()){
            $requestBody=$request->getBody();
            $taskForm->delete($requestBody);
            $taskForm->setStatus($requestBody);
            $taskForm->export();


            $this->setLayout('auth');
            return $this->render("showTask",[
                'model' => $taskForm
            ]);
        }
        $taskForm->export();
        $this->setLayout('auth');
        return $this->render("showTask",[
            'model' => $taskForm
        ]);
    }


    public function createTask(Request $request)
    {
        $taskForm=new TaskForm();
        if ($request->isPost()){
            $taskForm->loadData($request->getBody());


            if ($taskForm->validate() && $taskForm->save()){


                Application::$app->session->setFlash('success','task Created');
                Application::$app->response->redirect('/');
                exit;
            }

            return  $this->render('createTask',
                [
                    'model'=>$taskForm,
                ]
            );


        }
        $this->setLayout('auth');
        return  $this->render('createTask',
            [
                'model'=>$taskForm,
            ]
        );

    }


    public function login(Request $request, Response $response)
    {

        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return ;
            }
        }
        $this->setLayout('auth');
        return $this->render("login",[
            'model' => $loginForm
        ]);
    }
    public function register(Request $request){
        $user=new User();
        if ($request->isPost()){
            $user->loadData($request->getBody());


            if ($user->validate() && $user->save()){


                Application::$app->session->setFlash('success','thanks for registering');
                Application::$app->response->redirect('/');
                exit;
            }

            return  $this->render('register',
            [
                'model'=>$user,
            ]
            );


        }
        $this->setLayout('auth');
        return  $this->render('register',
            [
                'model'=>$user,
            ]
        );
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        return $response->redirect('/');
    }


    public function profile()
    {

        return  $this->render('profile');
    }


}