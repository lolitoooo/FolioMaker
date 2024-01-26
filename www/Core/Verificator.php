<?php

namespace App\Core;

use App\Models\Users;

class Verificator
{
    public $isRegister = false;

    public function checkForm($config, $data, &$errors): bool
    {
        if( count($config['inputs']) != count($data)){
            $errors[] = "Tentative de hack";
            return false;
        }

        foreach ($config['inputs'] as $name => $input) {
            if (!isset($data[$name])) {
                $errors[] = "Tentative de hack";
                return false;
            }

            if ($input["type"] == "email" && !self::checkEmail($data[$name])) {
                $errors[] = "Email incorrect";
            } else if ($input["type"] == "password" && !self::checkPassword($data[$name])) {
                $errors[] = "Mot de passe incorrect";
            }
        }

        if (isset($data['email']) && !$this->isRegister) {
            $userModel = Users::findByEmail($data['email']);
            if (!$userModel) {
                $errors[] = "Utilisateur non trouvé.";
                return false;
            }
        }

        return empty($errors);
    }


    public static function checkpassword(String $password): bool
    {
        return (strlen($password)>=8 &&
            preg_match("#[a-z]#", $password) &&
            preg_match("#[A-Z]#", $password) &&
            preg_match("#[0-9]#", $password)
            );
    }

    public static function checkEmail(String $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }



}