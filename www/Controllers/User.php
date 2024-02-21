<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Users;
use App\Core\Verificator;
use App\Forms\UpdateUser;
use App\Forms\UpdateUserList;
use App\Forms\DeleteUser;
use App\Forms\CreateUser;

class User {

    public function create() {
        $form = new CreateUser();
        $configForm = $form->getConfig();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]) {
            $user = new Users();
            if ($user->findByEmail($_REQUEST['email'])) {
                $errors[] = "Cet email est déjà utilisé";
            }

            $verificator = new Verificator();
            if ($verificator->checkForm($configForm, $_REQUEST, $errors)) {
                $user = new Users();
                $user->setFirstname($_REQUEST['firstname']);
                $user->setLastname($_REQUEST['lastname']);
                $user->setEmail($_REQUEST['email']);
                $user->setPassword($_REQUEST['password']);
                $user->save();
                

                header('Location: /user/list');
                exit();
            }
        }

        $view = new View("User/create", "back"); // Assurez-vous que la vue 'User/create' existe
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }

    public function list() {
        $userModel = new Users();
        $users = $userModel->getAll();
    
        $view = new View("User/list", "front");
        $view->assign("users", $users);
        $view->assign("showSidebar", true);
    }

    public function editList() {
        $userModel = new Users();
        $currentUser = $userModel->getOneBy(['id' => $_GET['id']], 'object'); 
    
        $form = new UpdateUserList($currentUser->getId());
        $configForm = $form->getConfig();
    
        $view = new View("User/editList", "front");
        $view->assign("showSidebar", true);
        $view->assign("form", $configForm);
    }

    public function updateList() {
        $errors = []; 

        $userId = $_GET['id'] ?? $_SESSION['user_id']; 
        if ($userId === null) {
            die('No user ID provided');
        }

        $form = new UpdateUserList($userId);
        $configForm = $form->getConfig();
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if (!empty($_POST['password']) && !Verificator::checkPassword($_POST['password'])) {
                $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre.";
            }
    
            if (empty($errors)) {
                $user = new Users();
                $user->setId($userId);
                $user->updateUser($_POST); 
                header('Location: /user/list'); 
                exit();
            }
        }
    
        $view = new View("User/editList", "front");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors); 
    }
    
    public function edit() {
        $userModel = new Users();
        $currentUser = $userModel->getOneBy(['id' => $_SESSION['user_id']], 'object'); 

        $form = new UpdateUser();
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
    
        $form = new UpdateUser();
        $configForm = $form->getConfig();
    
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] === null) {

                $errors['user_id'] = "Identifiant utilisateur non défini ou invalide.";
            } else {
                $user = new Users();
                var_dump($_SESSION['user_id']);
                $user->setId(intval($_SESSION['user_id']));
    

                if (!empty($_POST['password']) && !Verificator::checkPassword($_POST['password'])) {
                    $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre.";
                }
    
                if (empty($errors)) {
                    $user->updateUser($_POST);
                    header('Location: /');
                    exit();
                }
            }
        }
    
        $view = new View("User/edit", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }
    

    
    
    public function deleteList() {

        session_start();
    
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['user_id'])) {

            $userId = $_POST['user_id'];
            $user = new Users();
            $user->setId($userId);
    
            if ($user->softDeleteUser()) {
                header('Location: /user/list');
                exit();
            } else {

                $_SESSION['error_message'] = "Une erreur s'est produite lors de la suppression.";
                header('Location: /user/list');
                exit();
            }
        } else {

            $_SESSION['error_message'] = "Aucun utilisateur spécifié pour la suppression.";
            header('Location: /user/list');
            exit();
        }
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
    
        $form = new DeleteUser();
        $configForm = $form->getConfig();
        $view = new View("User/delete", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $formErrors); 
    }
}
