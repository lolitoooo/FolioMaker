<?php 

namespace App\Forms;

use App\Models\Users;

class UpdateUser {

    private $currentUser;

    public function __construct() {
        if(isset($_SESSION['user_id'])) {
            $this->currentUser = Users::populate($_SESSION['user_id']);
        } else {
            $this->currentUser = null;
        }
    }

    public function getConfig(): array
    {
        $firstnameValue = $this->currentUser ? $this->currentUser->getFirstname() : '';
        $lastnameValue = $this->currentUser ? $this->currentUser->getLastname() : '';
        $emailValue = $this->currentUser ? $this->currentUser->getEmail() : '';

        return [
            "config" => [
                "method" => "POST",
                "action" => "/user/update", 
                "class" => "form",
                "id" => "form-update-user",
                "error" => "Erreurs" 
            ],
            "inputs" => [
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