<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

$url = $_SERVER["REQUEST_URI"];
$params = explode('/', $url);
// var_dump($params);
$controller = isset($params[2]) ? $params[2] : null;
$method = isset($params[3]) ? $params[3] : 'index';

$class = 'App\\Controllers\\' . $controller;
$obj = new $class();
$obj->$method();