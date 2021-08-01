<?php

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$rootDir = dirname(__DIR__);
$app = new Application($rootDir);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', 'contact');
$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->router->get('/register', [AuthController::class, 'index']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();