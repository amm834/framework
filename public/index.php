<?php

use App\Controllers\SiteController;
use App\Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$rootDir = dirname(__DIR__);
$app = new Application($rootDir);

$app->router->get('/',[SiteController::class,'home']);


$app->run();