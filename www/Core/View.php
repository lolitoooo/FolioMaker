<?php
namespace App\Core;

class View
{
    private String $view;
    private array $data = [];
    private String $template;
    public function __construct($view, $template = "back")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view): void
    {
        $view = "Views/".$view.".view.php";
        if(!file_exists($view)){
            die("la vue n'existe pas :".$view);
        }
        $this->view = $view;
    }

    public function setTemplate($template): void
    {
        $template = "Views/Templates/".$template.".tpl.php";
        if(!file_exists($template)){
            die("le template n'existe pas :".$template);
        }
        $this->template = $template;
    }

    public function assign(String $key, $value): void
    {
        $this->data[$key]=$value;
    }

    public function modal(string $name, array $config, array $errors = []): void
    {
        $modal = "Views/Modals/".$name.".php";
        if(!file_exists($modal)){
            die("le modal n'existe pas :".$modal);
        }
        include $modal;
    }

    public function __destruct(){
        $this->data['view'] = $this;
        extract($this->data);
        include $this->template;
    }
    

    public function isUserLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }


}