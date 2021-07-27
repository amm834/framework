<?php

use App\Core\Application;

require_once __DIR__.'/vendor/autoload.php';


$app = new Application();

$app->router->get('/',function (){
    return 'hello world';
});

$app->router->get('/user',fn()=>"hello from user");
$app->run();