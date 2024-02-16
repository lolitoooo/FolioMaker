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
                "action" => "", // Assurez-vous que cette route est correctement définie dans votre système de routage
                "class" => "form",
                "id" => "form-delete-user",
                "submit" => "Supprimer mon compte",
                "error" => "Erreurs" // Vous pouvez personnaliser le message d'erreur si nécessaire
            ],
            "inputs" => [
                "confirmation" => [
                    "type" => "checkbox",
                    "id" => "form-delete-confirmation",
                    "required" => true,
                    "placeholder" => "",
                    "class" => "form-input",
                    "label" => "Je confirme vouloir supprimer mon compte définitivement."
                ]
            ]
        ];
    }
}