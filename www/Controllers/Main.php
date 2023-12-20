<?php

namespace App\Controllers;

use App\Core\View;

class Main{

    public function home(): void
    {
        new View("Main/home", "back");
    }

    public function aboutUs(): void
    {
        echo "ceci est la page a propos";
    }

}