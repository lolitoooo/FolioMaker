<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Users;

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
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new Users();
    
            $user->setId($_SESSION['user_id']); 
    
            $user->updateUser($_POST); 
    
            header('Location: /'); 
            exit();
        }
    
        $view = new View("User/edit", "back");
        $view->assign("form", $configForm);
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
