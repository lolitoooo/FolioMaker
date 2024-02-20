<?php
namespace App\Forms;
class CreateUser
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"form",
                "id"=>"form-register",
                "submit"=>"Creer un utilisateur",
                "error"=>"Erreurs"
            ],
            "inputs"=>[
                "firstname"=>[
                    "type"=>"text",
                    "id"=>"form-register-firstname",
                    "required"=>true,
                    "placeholder"=>"Prénom",
                    "class"=>"form-input",
                ],
                "lastname"=>[
                    "type"=>"text",
                    "id"=>"form-register-lastname",
                    "required"=>true,
                    "placeholder"=>"Nom",
                    "class"=>"form-input",
                ],
                "email"=>[
                    "type"=>"email",
                    "id"=>"form-register-email",
                    "required"=>true,
                    "placeholder"=>"Email",
                    "class"=>"form-input",
                    "unicity"=>true
                ],
                "password"=>[
                    "type"=>"password",
                    "id"=>"form-register-password",
                    "required"=>true,
                    "placeholder"=>"Mot de passe",
                    "class"=>"form-input",
                ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "id"=>"form-regiser-password-confirm",
                    "required"=>true,
                    "placeholder"=>"Confirmation du mot de passe",
                    "class"=>"form-input",
                    "confirm"=>"password"
                ]
            ]
        ];
    }

}