<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/Sprint2/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Ajout des routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('post/{id:\d+}', ['controller' => 'Home', 'action' => 'post']);

$router->add('login', ['controller' => 'User', 'action' => 'login']);
$router->add('register', ['controller' => 'User', 'action' => 'register']);

$router->add('logout', ['controller' => 'Home', 'action' => 'logout']);

// Appele du routeur en fonction des paramètres
$router->dispatch($_SERVER['QUERY_STRING']);
