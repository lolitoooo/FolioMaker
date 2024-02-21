<?php

namespace App\Controllers;

use App\Core\View;

class Main{

    public function home(): void
    {
        $view = new View("Main/home", "back");
        $view->assign("showSidebar", true);
    }

    public function aboutUs(): void
    {
        echo "ceci est la page a propos";
    }

    public function components(): void
    {
        $view = new View("Main/components", "front");
    }

    public function dashboard(): void
    {
        $view = new View("Main/dashboard", "back");
        $view->assign("showSidebar", true);
    }

    public function sidebar(): void
    {
        $view = new View("Components/sidebar", "back");
    }

    public function editor(): void
    {
        $view = new View("Main/editor", "editor");
    }

}