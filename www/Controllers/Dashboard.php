<?php

namespace App\Controllers;

use App\Core\View;

class Dashboard{

    public function pages(): void
    {
        $view = new View("Dashboard/pages", "back");
    }
}