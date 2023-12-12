<?php
namespace App\Controllers;

use App\Core\View;
use App\Forms\Login;
use App\Forms\Register;
use App\Models\User;

class Security{

    public function login(): void
    {
        $form = new Login();
        $configForm = $form->getConfig();



        $view = new View("Security/login", "back");
        $view->assign("form", $configForm);
    }
    public function logout(): void
    {
        echo "Logout";
    }
    public function register(): void
    {
        $form = new Register();
        $configForm = $form->getConfig();

        $view = new View("Security/register", "back");
        $view->assign("form", $configForm);
    }


}