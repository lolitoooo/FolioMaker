<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Users;
use App\Core\Verificator;

class User {

    public function edit() {
        $userModel = new Users();
        $currentUser = $userModel->getOneBy(['id' => $_SESSION['user_id']], 'object'); 

        $form = new \App\Forms\UpdateUser();
        $configForm = $form->getConfig();

        foreach ($configForm['inputs'] as &$input) {
            if (isset($currentUser->{$input['id']})) {
                $input['value'] = $currentUser->{$input['id']}; 
            }
        }

        $view = new View("User/edit", "back");
        $view->assign("form", $configForm);
        // $view->assign("formErrors", $errors); // Si vous gérez les erreurs
    }

    public function update() {
        $form = new \App\Forms\UpdateUser();
        $configForm = $form->getConfig();
    
        $errors = []; 
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new Users();
            $user->setId($_SESSION['user_id']); 
    
            if (!empty($_POST['password']) && !Verificator::checkPassword($_POST['password'])) {
                $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre.";
            }
    
            if (empty($errors)) {
                $user->updateUser($_POST); 
                header('Location: /'); 
                exit();
            }
        }
    
        $view = new View("User/edit", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors); 
    }
    
    
    public function delete() {
        $formErrors = []; 
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new Users();
            $user->setId($_SESSION['user_id']); 
    
            if (isset($_POST['confirmation'])) {
                $user->softDeleteUser(); 
                header('Location: /register'); 
                exit();
            } else {
                $formErrors[] = "La confirmation de suppression est requise.";
            }
        }
    
        $form = new \App\Forms\DeleteUser();
        $configForm = $form->getConfig();
        $view = new View("User/delete", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $formErrors); 
    }
}
