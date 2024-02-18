<?php
namespace App\Forms;

class CreateMenu
{
    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/menu/create",
                "submit" => "Ajouter le menu",
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "placeholder" => "Nom du menu",
                    "required" => true,
                    "class" => "form-input",
                ],
                "description" => [
                    "type" => "text",
                    "placeholder" => "Description",
                    "required" => false,
                    "class" => "form-input",
                ],
                "content" => [
                    "type" => "text",
                    "placeholder" => "Structure JSON du contenu",
                    "required" => true,
                    "class" => "form-input",
                ]
            ]
        ];
    }
}
