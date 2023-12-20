<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\Setup;

class Installer {

    public function setup_site(): void
    {
        $form = new Setup();
        $configForm = $form->getConfig();

        $view = new View("Installer/setup_site", "back");
        $view->assign("form", $configForm);

    }

}