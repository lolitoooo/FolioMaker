<?php

namespace App\Core;

class Verificator
{

    public function checkForm($config, $data, &$errors): bool
    {
        if (count($config['inputs']) != count($data)) {
            $errors[] = "Nombre de champs soumis incorrect.";
        }

        foreach ($config['inputs'] as $name => $input) {
            if (!isset($data[$name])) {
                $errors[] = "Champ {$name} manquant, tentative de manipulation suspecte.";
            } else {
                if ($input["type"] == "email" && !self::checkEmail($data[$name])) {
                    $errors[] = "L'email fourni est incorrect.";
                } elseif ($input["type"] == "password" && !self::checkPassword($data[$name])) {
                    $errors[] = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre.";
                }
            }
        }

        if (isset($data['firstname']) && strlen($data['firstname']) < 2) {
            $errors[] = "Le prénom est trop court.";
        }

        if (isset($data['firstname']) && isset($data['lastname']) && $data['firstname'] == $data['lastname']) {
            $errors[] = "Le prénom et le nom ne peuvent pas être identiques.";
        }

        if (isset($data['password']) && isset($data['passwordConfirm']) && $data['password'] != $data['passwordConfirm']) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        return empty($errors);
    }


    public static function checkPassword(String $password): bool
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