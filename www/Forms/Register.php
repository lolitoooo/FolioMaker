<?php

namespace App\Forms;

class Register
{
    public function __construct(){

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
                "firstname" => [
                    "type" => "firstname",
                    "id" => "form-register-firstname",
                    "required" => true,
                    "placeholder" => "Votre prénom",
                    "class" => "form-input",
                ],
                "lastname" => [
                    "type" => "lastname",
                    "id" => "form-register-lastname",
                    "required" => true,
                    "placeholder" => "Votre nom",
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
            ]
        ];
    }
}
