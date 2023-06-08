<?php declare(strict_types=1);

use App\Core\Redirect;
use App\Core\Renderer;
use App\Core\Router;
use App\Core\InputValidator;
use App\Core\View;

require_once '../vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$routes = require_once '../routes.php';
$response = Router::route($routes);

if($response instanceof View){
    echo (new Renderer())->render($response);
    \App\Core\Session::unflash();
}

if($response instanceof Redirect){
    header('Location: '.$response->getPath());
}

if($response instanceof InputValidator){
    echo json_encode($response->isResponse());
}

