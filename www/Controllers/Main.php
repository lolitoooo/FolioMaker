<?php

namespace App\Controllers;

use App\Core\View;

class Main{

    public function home(): void
    {
        echo "ceci est la page d'accueil";
    }

    public function aboutUs(): void
    {
        echo "ceci est la page a propos";
    }

}