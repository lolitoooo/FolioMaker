<?php
namespace App\Forms;

class DeleteMenu
{
    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/menu/delete",
                "submit" => "Supprimer le menu",
            ],
            "inputs" => [
                "menu_id" => [
                    "type" => "hidden",
                    "required" => true,
                ],
                "confirmation" => [
                    "type" => "checkbox",
                    "label" => "Je confirme vouloir supprimer ce menu",
                    "required" => true,
                    "class" => "form-check-input",
                ]
            ]
        ];
    }
}
