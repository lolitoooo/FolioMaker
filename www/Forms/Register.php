<?php

namespace App\Forms;

class Register
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
                "id" => "form-register",
                "submit" => "s'inscrire",
                "error" => "Les informations fournies sont incorrectes",
                "enctype" => "multipart/form-data",
                "autocomplete" => "on"
            ],
            "inputs" => [
                "username" => [
                    "type" => "text",
                    "id" => "form-register-username",
                    "required" => true,
                    "placeholder" => "Votre nom d'utilisateur",
                    "class" => "form-input",
                ],
                "email" => [
                    "type" => "email",
                    "id" => "form-register-email",
                    "required" => true,
                    "placeholder" => "Votre email",
                    "class" => "form-input",
                ],
                "pwd" => [
                    "type" => "password",
                    "id" => "form-register-pwd",
                    "required" => true,
                    "placeholder" => "Votre mot de passe",
                    "class" => "form-input",
                ],
                "confirm_pwd" => [
                    "type" => "password",
                    "id" => "form-register-confirm-pwd",
                    "required" => true,
                    "placeholder" => "Confirmez votre mot de passe",
                    "class" => "form-input",
                ],
                "additional_field" => [
                    "type" => "text",
                    "id" => "form-register-additional-field",
                    "required" => false,
                    "placeholder" => "Champ supplémentaire",
                    "class" => "form-input",
                ],
            ]
        ];
    }
}
