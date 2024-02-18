<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Menus;
use App\Forms\CreateMenu;
use App\Core\Verificator;
use App\Forms\EditMenu;

class Menu {
    public function list() {
        $menuModel = new Menus();
        $menus = $menuModel->getAllMenus();
        (new View("menu/list"))->assign("menus", $menus);
    }

    public function showAdd() {
        $form = new CreateMenu();
        $configForm = $form->getConfig();
    
        $errors = [];
    
        if ($_SERVER['REQUEST_METHOD'] === $configForm["config"]["method"]) {
            $verificator = new Verificator();
    
            if ($verificator->checkForm($configForm, $_POST, $errors)) {
                $menuModel = new Menus();
                $userId = $_SESSION['user_id'] ?? null; 
    
                if ($userId) {
                    $menuModel->addMenu($_POST['name'], $_POST['description'], $_POST['content'], $userId);
                    header("Location: /menu/list"); 
                    exit();
                } else {
                    $errors[] = "Vous devez être connecté pour créer un menu.";
                }
            }
        }
    
        $view = new View("menu/create");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }
    

    public function showEdit($id) {
        $menuModel = new Menus();
        $menu = $menuModel->getById($id);
    
        $editMenuForm = new EditMenu($id);
        $form = $editMenuForm->getConfig();
    
        $view = new View("menu/edit");
        $view->assign("menu", $menu);
        $view->assign("form", $form); 
    }
    

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['description'], $_POST['content'])) {
            $menuModel = new Menus();
            $userId = $_SESSION['user_id']; 
            $menuModel->updateMenu($id, $_POST['name'], $_POST['description'], $_POST['content'], $userId);

            header("Location: /menu/list");
            exit();
        } else {
            $menu = (new Menus())->getById($id);
            $view = new View("menu/edit");
            $view->assign("menu", $menu);
            $view->assign("error", "Invalid Input");
        }
    }

    // Supprimer un menu
    public function delete() {
        if (isset($_POST['menu_id'])) {
            $id = $_POST['menu_id'];
            $menuModel = new Menus();
            $menuModel->deleteMenu($id);
            header("Location: /menu/list"); 
            exit();
        } else {
            header("Location: /menu/list?error=menuIdMissing");
            exit();
        }
    }
    
}
