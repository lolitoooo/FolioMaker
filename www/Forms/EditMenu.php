<?php 
namespace App\Forms;

use App\Models\Menus;

class EditMenu {
    private $currentMenu;

    public function __construct($menuId) {
        $menuModel = new Menus();
        $this->currentMenu = $menuModel->getById($menuId);
    }
    
    
    public function getConfig(): array {
        $nameValue = isset($this->currentMenu['name']) ? $this->currentMenu['name'] : '';
        $descriptionValue = isset($this->currentMenu['description']) ? $this->currentMenu['description'] : '';
        $contentValue = isset($this->currentMenu['content']) ? htmlspecialchars($this->currentMenu['content'], ENT_QUOTES, 'UTF-8') : '';



        return [
            "config" => [
                "method" => "POST",
                "action" => "/menu/update/" . $this->currentMenu['id'],
                "submit" => "Modifier le menu",
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "placeholder" => "Nom du menu",
                    "required" => true,
                    "class" => "form-input",
                    "value" => $nameValue,
                ],
                "description" => [
                    "type" => "text",
                    "placeholder" => "Description",
                    "required" => false,
                    "class" => "form-input",
                    "value" => $descriptionValue,
                ],
                "content" => [
                    "type" => "text",
                    "placeholder" => "Structure JSON du contenu",
                    "required" => true,
                    "class" => "form-input",
                    "value" => $contentValue,
                ]
            ]
        ];
    }
}
