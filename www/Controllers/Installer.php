<?php

namespace App\Controllers;

use App\Core\View;

class Installer {

    public function setup_site(): void
    {
        new View("Installer/setup_site", "back");
    }

    public function setup_bdd(): void
    {
        new View("Installer/setup_bdd", "back");
    }

}