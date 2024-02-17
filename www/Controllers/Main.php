<?php

namespace App\Controllers;

use App\Core\View;

class Main{

    public function home(): void
    {
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
    }

}