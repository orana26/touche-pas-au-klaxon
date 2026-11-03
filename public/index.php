<?php
declare(strict_types=1);
session_start();
require dirname(__DIR__).'/vendor/autoload.php';

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\TripController;
use App\Controllers\AdminController;

$router=new Router();
$trip=new TripController(); $auth=new AuthController(); $admin=new AdminController();

$router->get('/', [$trip,'index']);
$router->get('/login', [$auth,'loginForm']); $router->post('/login', [$auth,'login']); $router->post('/logout', [$auth,'logout']);
$router->get('/trips/create', [$trip,'createForm']); $router->post('/trips', [$trip,'create']);
$router->get('/trips/{id}/edit', [$trip,'editForm']); $router->post('/trips/{id}/update', [$trip,'update']); $router->post('/trips/{id}/delete', [$trip,'delete']);

$router->get('/admin', [$admin,'dashboard']); $router->get('/admin/users', [$admin,'users']);
$router->get('/admin/agencies', [$admin,'agencies']); $router->get('/admin/agencies/create', [$admin,'agencyCreate']);
$router->post('/admin/agencies', [$admin,'agencyStore']); $router->get('/admin/agencies/{id}/edit', [$admin,'agencyEdit']);
$router->post('/admin/agencies/{id}/update', [$admin,'agencyUpdate']); $router->post('/admin/agencies/{id}/delete', [$admin,'agencyDelete']);
$router->get('/admin/trips', [$admin,'trips']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);