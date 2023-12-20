<?php
namespace App\Forms;
class Login
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"login",
                "id"=>"form-login",
                "submit"=>"s'inscrire",
                "submitClass"=>"formLoginButton",
                "error"=>"Identifiants incorrects"
            ],
            "inputs"=>[
                "username"=>[
                    "type"=>"text",
                    "id"=>"form-login-email",
                    "required"=>true,
                    "placeholder"=>"Username",
                    "class"=>"formLoginInput",
                ],
                "pwd"=>[
                    "type"=>"password",
                    "id"=>"form-login-pwd",
                    "required"=>true,
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"formLoginInput",
                ]
            ]
        ];
    }

}