<?php 

namespace App\Forms;

class DeleteUser
{
    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "", 
                "class" => "form",
                "id" => "form-delete-user",
                "submit" => "Supprimer mon compte",
                "error" => "Erreurs" 
            ],
            "inputs" => [
                "confirmation" => [
                    "type" => "checkbox",
                    "id" => "form-delete-confirmation",
                    "required" => true,
                    "placeholder" => "",
                    "class" => "input",
                    "label" => "Je confirme vouloir supprimer mon compte définitivement."
                ]
            ]
        ];
    }
}