<?php

namespace App;

session_start();

spl_autoload_register("App\myAutoloader");
function myAutoloader($class)
{
    $class = str_replace("App\\", "", $class);
    $class = str_replace("\\", "/", $class) . ".php";
    if (file_exists($class)) {
        include $class;
    }
}

$uri = strtolower($_SERVER["REQUEST_URI"]);
$uri = strtok($uri, "?");
if (strlen($uri) > 1) $uri = rtrim($uri, "/");

$fileRoute = "routes.yaml";
if (!file_exists($fileRoute)) {
    die("Le fichier de routing n'existe pas.");
}
$listOfRoutes = yaml_parse_file($fileRoute);

$foundRoute = false;
foreach ($listOfRoutes as $route => $info) {
    $routePattern = preg_replace('#\{([a-z]+)\}#', '([^/]+)', $route);
    if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {
        array_shift($matches); 
        $foundRoute = true;
        $controller = $info["controller"];
        $action = $info["action"];

        $controllerFile = "Controllers/" . $controller . ".php";
        if (file_exists($controllerFile)) {
            include $controllerFile;
            $controllerClass = "App\\Controllers\\" . $controller;
            if (class_exists($controllerClass)) {
                $object = new $controllerClass();
                if (method_exists($object, $action)) {
                    call_user_func_array([$object, $action], $matches);
                } else {
                    die("L'action " . $action . " n'existe pas.");
                }
            } else {
                die("La classe " . $controllerClass . " n'existe pas.");
            }
        } else {
            die("Le fichier " . $controllerFile . " n'existe pas.");
        }
        break;
    }
}

if (!$foundRoute) {
    include "Controllers/Error.php";
    $object = new Controllers\Error();
    $object->page404();
}
