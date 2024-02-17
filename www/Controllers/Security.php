<?php
namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\Login;
use App\Forms\Register;
use App\Models\Users;
use App\Controllers\Mail;

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
                $user = new Users();
            
                $loginResult = $user->login($email, $password);
            
                switch ($loginResult) {
                    case 1: // Connexion réussie
                        session_start();
                        $_SESSION['email'] = $email;
                        header('Location: /');
                        exit();
                        break;
            
                    case 2: // Compte non vérifié par e-mail
                        $errors[] = "Compte non vérifié. Veuillez vérifier votre e-mail.";
                        break;
            
                    case 3: // Mot de passe incorrect
                        $errors[] = "Mot de passe incorrect.";
                        break;
            
                    case 4: // Adresse e-mail incorrecte
                        $errors[] = "Adresse e-mail incorrecte.";
                        break;
            
                    default:
                        $errors[] = "Une erreur inattendue s'est produite.";
                        break;
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
                $mail = new Mail();
                $subject = "Vérification de votre adresse e-mail";
                $message  ="
                <html>
                <body>
                <h1>Vérification de votre adresse e-mail</h1>
                <p>Pour valider votre adresse e-mail, veuillez cliquer sur le lien suivant : <a href='http://localhost/verify_email'>Valider mon adresse e-mail</a></p>
                </body>
                </html>
                ";
                $mail->sendMail($_REQUEST['email'], $message, $subject);
                header('Location: /');
            }
        }

        $view = new View("Security/register", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }

    public function verifyEmail()
{
    session_start();

    $message = '';

    if (isset($_SESSION['email_for_verification'])) {
        $emailToVerify = $_SESSION['email_for_verification'];
        $userModel = new Users(); 

        if ($userModel->verifyEmail($emailToVerify)) {
            $message = 'success';
        } else {
            $message = 'failure';
        }
    } else {
        $message = 'missing_param';
    }

    $view = new View("Mail/verifMail", "back");
    $view->assign("message", $message);
}


}