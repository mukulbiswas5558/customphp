<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'helpers/helpers.php';
require_once 'core/Router.php'; // Load Router
require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/UserController.php';

// Initialize Router
$router = new Router('/page_maker/avenger');

// Define routes and associate with controller methods
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/contact', [HomeController::class, 'contact']);

$router->get('/user', [UserController::class, 'index']);
$router->post('/submit', [UserController::class, 'submit']);

$router->get('/formCreate', [UserController::class, 'formCreate']);
$router->post('/formSubmit', [UserController::class, 'formSubmit']);

$router->get('/responseCreate', [UserController::class, 'responseCreate']);
$router->get('/responseCreateView', [UserController::class, 'responseCreateView']);

$router->post('/responseSubmit', [UserController::class, 'responseSubmit']);

$router->get('/profile', [UserController::class, 'profile']);
$router->post('/user/create', [UserController::class, 'createUser']);

// PUT route
$router->put('/user/update', [UserController::class, 'updateUser']);

// DELETE route
$router->delete('/user/delete', [UserController::class, 'deleteUser']);

// Dispatch the route
$router->dispatch();
?>