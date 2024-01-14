<?php
namespace App\Controllers;

use App\Core\View;
use App\Forms\Login;
use App\Forms\Register;
use App\Models\Users;

class Security{

    public function login(): void {
        $form = new Login();
        $configForm = $form->getConfig();
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = $_POST['email'] ?? '';
            $password = $_POST['pwd'] ?? '';

            // Validation des données
            if (!empty($email) && !empty($password)) {
                // Rechercher l'utilisateur dans la base de données
                $userModel = Users::findByEmail($email);

                $hashedPasswordFromDb = $userModel->getPassword();

                if ($userModel && password_verify($password, $hashedPasswordFromDb)) {
                    // Authentification réussie
                    $_SESSION['user_id'] = $userModel->getId();

                    // Redirection vers la page d'accueil ou toute autre page après la connexion
                    header('Location: /'); 
                    exit();
                } else {
                    // Authentification échouée
                    // Afficher un message d'erreur
                    echo "Identifiants incorrects.";
                }
            } else {
                // Gérer l'erreur de champs vides
                echo "Veuillez remplir tous les champs.";
            }
        }

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['pwd'] ?? '';
            $confirmPassword = $_POST['confirm_pwd'] ?? '';

            // Afficher les données pour le débogage
            var_dump($_POST);

            // Validation (ajustée pour correspondre aux champs disponibles)
            if ($password === $confirmPassword && !empty($email) && !empty($password)) {
                // Création de l'utilisateur
                $userModel = new Users();
                $userModel->setFirstname($firstname);
                $userModel->setLastname($lastname);
                $userModel->setEmail($email);
                $userModel->setPassword($password);

                // Insérer dans la base de données
                $userModel->save();
                header('Location: /login');
                exit;
            } else {
                // Gérer l'erreur de confirmation de mot de passe ou de champs vides
                echo "Erreur de validation";
            }
        }

        $view = new View("Security/register", "back");
        $view->assign("form", $configForm);
    }




}