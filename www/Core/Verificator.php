<?php

namespace App\Core;

class Verificator
{

    public function checkForm($config, $data, &$errors): bool
    {

        if( count($config['inputs']) != count($data)){
            die("Tentative de hack");
        }
        //Token CSRF ????
        foreach ($config['inputs'] as $name=>$input){
            if(!isset($data[$name])){
                die("Tentative de hack");
            }
            //Commencer à traiter les verification micro

            if($input["type"]=="email" && !self::checkEmail($data[$name])){
                $errors[]="Email incorrect";
            }
            elseif($input["type"]=="password" && !self::checkPassword($data[$name])){
                $errors[]="Mot de passe incorrect";
            }
        }

        if(strlen($data['firstname'])<2){
            $errors[]="Le prénom est trop cours";
        }

        if($data['firstname'] == $data['lastname']){
            $errors[]="Le prénon et le nom ne peuvent pas être identiques";
        }

        if($data['password'] != $data['passwordConfirm']){
            $errors[]="Les mots de passe ne correspondent pas";
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