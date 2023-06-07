<?php declare(strict_types=1);

use App\Core\Renderer;
use App\Core\Router;
use App\Core\View;

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$routes = require_once '../routes.php';
$response = Router::route($routes);

if($response instanceof View){
    echo (new Renderer())->render($response);
}

if($response instanceof \App\Core\Redirect){
    header('Location: '.$response->getPath());
}

