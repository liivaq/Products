<?php declare(strict_types=1);

use App\Core\Renderer;
use App\Core\Response\Redirect;
use App\Core\Response\Validation;
use App\Core\Response\View;
use App\Core\Router;
use App\Core\Session;

require_once '../vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$routes = require_once '../routes.php';
$response = Router::route($routes);

if($response instanceof View){
    echo (new Renderer())->render($response);
    Session::unflash();
}

if($response instanceof Redirect){
    header('Location: '.$response->getPath());
}

if($response instanceof Validation){
    echo json_encode($response->isResponse());
}

