<?php

namespace App\Controllers;

use App\Core\View;

class Main {

    public function home(): void {
        $view = new View("Main/home", "front");
        $view->assign("isLoggedIn", $view->isUserLoggedIn());
    }

    public function aboutUs(): void {
        $view = new View("Main/aboutUs", "front");
    }

    public function components(): void {
        $view = new View("Main/components", "front");
    }

}
