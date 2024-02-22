<?php 

namespace App\Forms;

use App\Models\Users;

class UpdateUserList {

    private $currentUser;

    public function __construct(int $userId) {
        $this->currentUser = Users::populate($userId);
    }

    public function getConfig(): array
    {
        $firstnameValue = $this->currentUser ? $this->currentUser->getFirstname() : '';
        $lastnameValue = $this->currentUser ? $this->currentUser->getLastname() : '';
        $emailValue = $this->currentUser ? $this->currentUser->getEmail() : '';

        return [
            "config" => [
                "method" => "POST",
                "action" => "/user/updateList?id=" . $this->currentUser->getId(),
                "class" => "form",
                "id" => "form-update-user",
                "error" => "Erreurs" 
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "value" => $this->currentUser->getId(),
                    "required" => false,
                ],
                "firstname" => [
                    "type" => "text",
                    "id" => "form-update-firstname",
                    "required" => false,
                    "placeholder" => "Votre prénom",
                    "class" => "input",
                    "value" => $firstnameValue, 
                    "submitLabel" => "Modifier",
                ],
                "lastname" => [
                    "type" => "text",
                    "id" => "form-update-lastname",
                    "required" => false,
                    "placeholder" => "Votre nom",
                    "class" => "input",
                    "value" => $lastnameValue, 
                    "submitLabel" => "Modifier",
                ],
                "email" => [
                    "type" => "email",
                    "id" => "form-update-email",
                    "required" => false,
                    "placeholder" => "Votre email",
                    "class" => "input",
                    "value" => $emailValue, 
                    "unicity" => true,
                    "submitLabel" => "Modifier",
                ],
                "password" => [
                    "type" => "password",
                    "id" => "form-update-password",
                    "required" => false, 
                    "placeholder" => "Nouveau mot de passe (laisser vide si inchangé)",
                    "class" => "input",
                    "submitLabel" => "Modifier",
                ]
            ]
        ];
    }
}