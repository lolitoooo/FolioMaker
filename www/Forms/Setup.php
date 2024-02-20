<?php
namespace App\Forms;
class Setup
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"form_installer",
                "id"=>"form-installer",
                "submit"=>"Finish",
                "error"=>""
            ],
            "inputs"=>[
                "site_title"=>[
                    "type"=>"text",
                    "id"=>"site_title",
                    "required"=>true,
                    "placeholder"=>"Portfolio Title",
                    "class"=>"input",
                ],
                "site_username"=>[
                    "type"=>"text",
                    "id"=>"site_username",
                    "required"=>true,
                    "placeholder"=>"Username",
                    "class"=>"input",
                ],
                "site_password"=>[
                    "type"=>"password",
                    "id"=>"site_password",
                    "required"=>true,
                    "placeholder"=>"Password",
                    "class"=>"input",
                ],
                "site_confirm_password"=>[
                    "type"=>"password",
                    "id"=>"site_confirm_password",
                    "required"=>true,
                    "placeholder"=>"Confirm Password",
                    "class"=>"input",
                ],
                "site_email"=>[
                    "type"=>"email",
                    "id"=>"site_email",
                    "required"=>true,
                    "placeholder"=>"Email",
                    "class"=>"input",
                ],
                "db_name"=>[
                    "type"=>"text",
                    "id"=>"db_name",
                    "required"=>true,
                    "placeholder"=>"Database Name",
                    "class"=>"input",
                ],
                "db_username"=>[
                    "type"=>"text",
                    "id"=>"db_username",
                    "required"=>true,
                    "placeholder"=>"Database Username",
                    "class"=>"input",
                ],
                "db_password"=>[
                    "type"=>"text",
                    "id"=>"db_password",
                    "required"=>true,
                    "placeholder"=>"Password",
                    "class"=>"input",
                ],
                "db_host"=>[
                    "type"=>"text",
                    "id"=>"db_host",
                    "required"=>true,
                    "placeholder"=>"Host",
                    "class"=>"input",
                    "value"=>"db",
                ],
                "table_prefix"=>[
                    "type"=>"text",
                    "id"=>"table_prefix",
                    "required"=>true,
                    "placeholder"=>"Table Prefix",
                    "class"=>"input",
                    "value"=>"esgi",
                ]
            ]
        ];
    }

}