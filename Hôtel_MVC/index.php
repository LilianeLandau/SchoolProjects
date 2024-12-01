<?php
//démarrer la session
session_start();
require 'config/constant.php';
require 'config/db.php';
require 'config/repositories.php';
require 'config/models.php';
require 'config/controllers.php';
require 'Router.php';

//CREER ROUTER
$router = new Router();
$elements = $router->getController($_SERVER['REQUEST_URI']);
$controller = $elements['controller'];
//initialiser une instance du controller
$cont = new $controller($dbh);
//appeler l'action du controller
$action = $elements['action'];

if (!empty($elements['id'])) {
    $cont->$action($elements['id']);
} else {
    $cont->$action();
}
