<?php
namespace App\Forms;
class Register
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
                "submit"=>"s'inscrire",
                "error"=>"Erreurs"
            ],
            "inputs"=>[
                "firstname"=>[
                    "type"=>"text",
                    "id"=>"form-register-firstname",
                    "required"=>true,
                    "placeholder"=>"Votre prénom",
                    "class"=>"input",
                ],
                "lastname"=>[
                    "type"=>"text",
                    "id"=>"form-register-lastname",
                    "required"=>true,
                    "placeholder"=>"Votre nom",
                    "class"=>"input",
                ],
                "email"=>[
                    "type"=>"email",
                    "id"=>"form-register-email",
                    "required"=>true,
                    "placeholder"=>"Votre email",
                    "class"=>"input",
                    "unicity"=>true
                ],
                "password"=>[
                    "type"=>"password",
                    "id"=>"form-register-password",
                    "required"=>true,
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"input",
                ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "id"=>"form-regiser-password-confirm",
                    "required"=>true,
                    "placeholder"=>"Confirmation du mot de passe",
                    "class"=>"input",
                    "confirm"=>"password"
                ]
            ]
        ];
    }

}