<?php

use App\Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$rootDir = dirname(__DIR__);
$app = new Application($rootDir);

$app->router->get('/','home');

$app->run();