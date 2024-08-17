<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use app\core\Application;
$config=[
    'userClass' =>\app\models\User::class ,
  'db'=>[
      'dsn'=>$_ENV['DB_DSN'],
      'user'=>$_ENV['DB_USER'],
      'password'=>$_ENV['DB_PASSWORD'],
  ]
];

$app = new Application(dirname(__DIR__),$config);

$app->router->get(
    '/',
    [new \app\controllers\SiteController, 'home']
);

$app->router->get(
    '/contact',
    [new \app\controllers\SiteController, 'contact']
);
$app->router->post('/contact',

    [new \app\controllers\SiteController, 'contact']

);


$app->router->get(
    '/login',
    [new \app\controllers\AuthController, 'login']
);

$app->router->post(
    '/login',
    [new \app\controllers\AuthController, 'login']
);
$app->router->get(
    '/register',
    [new \app\controllers\AuthController, 'register']
);
$app->router->post(
    '/register',
    [new \app\controllers\AuthController, 'register']
);

$app->router->get(
    '/logout',
    [new \app\controllers\AuthController, 'logout']
);

$app->router->get(
    '/profile',
    [new \app\controllers\AuthController, 'profile']
);


$app->router->get(
    '/showTask',
    [new \app\controllers\AuthController, 'showTask']
);
$app->router->post(
    '/showTask',
    [new \app\controllers\AuthController, 'showTask']
);



$app->router->get(
    '/createTask',
    [new \app\controllers\AuthController, 'createTask']
);

$app->router->post(
    '/createTask',
    [new \app\controllers\AuthController, 'createTask']
);


$app->run();
