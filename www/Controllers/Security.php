<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Users;

class Security{

    public function login(): void
    {
        $myuser = new Users();
        $myuser->setId(5);
        $myuser->setFirstname("Loan");
        $myuser->setLastname("Pena");
        $myuser->setEmail("lpena@myges.fr");
        $myuser->setPassword("Respons11");
        $myuser->save();
        new View("Security/login", "back");
    }
    public function logout(): void
    {
        echo "Logout";
    }
    public function register(): void
    {
        echo "Register";
    }


}