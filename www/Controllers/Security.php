<?php
namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\Login;
use App\Forms\Register;
use App\Models\Users;

class Security{

    public function login(): void
    {
        $form = new Login();
        $configForm = $form->getConfig();


        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === $configForm["config"]["method"]) {
            $verificator = new Verificator();
    
            if ($verificator->checkForm($configForm, $_POST, $errors)) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $userModel = Users::findByEmail($email);
    
                if (password_verify($password, $userModel->getPassword())) {
                    $_SESSION['user_id'] = $userModel->getId();
                    header('Location: /');
                    exit();
                } else {
                    $errors[] = "Mot de passe incorrect.";
                }
            }
        }

        $view = new View("Security/login", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }
    public function logout(): void
    {
        echo "Logout";
    }
    public function register(): void
    {
        $form = new Register();
        $configForm = $form->getConfig();

        $errors = [];

        if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){

            $user = new Users();
            if($user->getOnByEmail($_REQUEST['email'])){
                $errors[]="Cet email est déjà utilisé";
            }

            $verificator = new Verificator();
            //Est-ce que les données sont OK
            if($verificator->checkForm($configForm, $_REQUEST, $errors))
            {
                $user = new Users();
                $user->setFirstname($_REQUEST['firstname']);
                $user->setLastname($_REQUEST['lastname']);
                $user->setEmail($_REQUEST['email']);
                $user->setPassword($_REQUEST['password']);
                $user->save();
                session_start();
                $_SESSION['email'] = $_REQUEST['email'];
                header('Location: /');
            }
        }

        $view = new View("Security/register", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }
}