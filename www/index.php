<?php

namespace App;

use App\Controllers\Page;
use App\Models\Pages;

spl_autoload_register("App\myAutoloader");

function myAutoloader($class)
{
    $file = str_replace("App\\", "", $class);
    $file = str_replace("\\", "/", $file);
    $file .= ".php";
    if (file_exists($file)) {
        include $file;
    }
}

// Récupérer l'URI demandée
$uri = strtolower($_SERVER["REQUEST_URI"]);
$uri = strtok($uri, "?");
if (strlen($uri) > 1) $uri = rtrim($uri, "/");

$fileRoute = "routes.yaml";
if (file_exists($fileRoute)) {
    $listOfRoutes = yaml_parse_file($fileRoute);
} else {
    die("Le fichier de routing n'existe pas");
}

// Vérifier si l'URI demandée correspond à une route définie dans routes.yaml
if (!empty($listOfRoutes[$uri])) {
    if (!empty($listOfRoutes[$uri]["controller"])) {
        if (!empty($listOfRoutes[$uri]["action"])) {

            $controller = $listOfRoutes[$uri]["controller"];
            $action = $listOfRoutes[$uri]["action"];

            if (file_exists("Controllers/" . $controller . ".php")) {
                include "Controllers/" . $controller . ".php";
                $controller = "App\\Controllers\\" . $controller;
                if (class_exists($controller)) {
                    $object = new $controller();
                    if (method_exists($object, $action)) {
                        // Si l'URI correspond à une route définie dans routes.yaml, exécutez l'action correspondante
                        $object->$action();
                    } else {
                        die("L'action' " . $action . " n'existe pas");
                    }
                } else {
                    die("Le class controller " . $controller . " n'existe pas");
                }
            } else {
                die("Le fichier controller " . $controller . " n'existe pas");
            }
        } else {
            die("La route " . $uri . " ne possède pas d'action dans le ficher " . $fileRoute);
        }
    } else {
        die("La route " . $uri . " ne possède pas de controller dans le ficher " . $fileRoute);
    }
} else {
    // Si l'URI ne correspond pas à une route définie dans routes.yaml, récupérez la page correspondante depuis la base de données
    $page = new Pages();
    $pageData = $page->getOneBy(["path" => $uri], "object");

    if ($pageData) {
        // Si une page correspondante est trouvée, utilisez le contrôleur Page et l'action viewPage pour afficher le contenu
        // Appelle la méthode viewPage() du contrôleur Page avec $uri comme paramètre
        // Appelle la méthode viewPage() du contrôleur Page avec $uri comme paramètre
        $controller = new \App\Controllers\Page();
        $controller->viewPage($uri);
    } else {
        // Si aucune page correspondante n'est trouvée, affichez une erreur 404
        include "Controllers/Error.php";
        $object = new Controllers\Error();
        $object->page404();
    }
}
