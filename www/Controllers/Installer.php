<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\Setup;
use App\Models\Users;
use App\Controllers\Mail;

class Installer {

    public function setup_site(): void
    {
        $form = new Setup();
        $configForm = $form->getConfig();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === $configForm["config"]["method"]) {
            $verificator = new Verificator();

            if ($verificator->checkForm($configForm, $_POST, $errors)) {

                $userDoker = "foliomakeruser";
                $passwordDoker = "foliomakerpsw";

                // ===== Create config file ===== //
                $filename = "./config/config.php";
                touch($filename);

                // ===== Create database and tables ===== //
                $config = [
                    "db_name"=>$_POST["db_name"],
                    "db_username"=>$_POST["db_username"],
                    "db_password"=>$_POST["db_password"],
                    "db_host"=>$_POST["db_host"],
                    "table_prefix"=>$_POST["table_prefix"],
                ];

                // ===== Create database and tables ===== //
                $connect = "pgsql:host={$config['db_host']};port=5432;dbname={$config['db_name']}";
                $dbUser = $config["db_username"];
                $dbPassword = $config["db_password"];

                $createDatabase = "CREATE DATABASE IF NOT EXISTS ".$config["db_name"].";";

                if(isset($config["table_prefix"]) && !empty($config["table_prefix"])){
                    $config["table_prefix"] = $config["table_prefix"]."_";
                }
                
                $createTableUser = "CREATE TABLE IF NOT EXISTS ".$config["table_prefix"]."users (id SERIAL PRIMARY KEY,firstname varchar(25) NOT NULL,lastname varchar(25) NOT NULL,email varchar(320) NOT NULL,password varchar(255) NOT NULL,status smallint NOT NULL DEFAULT 0,isverif bool NOT NULL DEFAULT false,isDeleted smallint NOT NULL DEFAULT 0,insertedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,updatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP);";
                $createTableMenu = "CREATE TABLE IF NOT EXISTS ".$config["table_prefix"]."menus (id SERIAL PRIMARY KEY,name VARCHAR(255) NOT NULL,description VARCHAR(255),content JSON NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,deleted_at TIMESTAMP NULL,user_updated_at INT,FOREIGN KEY (user_updated_at) REFERENCES esgi_users(id));";

                // ===== Execute SQL ===== //
                try {
                    // Connexion à PostgreSQL en tant qu'utilisateur administrateur
                    $adminPdo = new \PDO("pgsql:host=db;port=5432;dbname=postgres", $userDoker, $passwordDoker);
                    $adminPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                
                    // Créer l'utilisateur MySQL
                    // $adminPdo->exec("CREATE USER ".$dbUser." WITH PASSWORD '".$dbPassword."';");
                
                    // Vérifier si la base de données existe
                    $stmt = $adminPdo->prepare("SELECT 1 FROM pg_database WHERE datname = :dbname");
                    $stmt->execute(['dbname' => $config["db_name"]]);
                
                    // Si la base de données n'existe pas, alors la créer
                    if (!$stmt->fetchColumn()) {
                        $adminPdo->exec("CREATE DATABASE " . $config["db_name"] . " ENCODING 'UTF8' TEMPLATE template0");
                    }

                    $adminPdo->exec("ALTER DATABASE " . $config["db_name"] . " OWNER TO ".$dbUser.";");
                
                    // Déconnexion de l'utilisateur administrateur
                    $adminPdo = null;
                
                    // ===== Connexion à la base de données en tant que nouvel utilisateur ===== //

                    // Connexion à la base de données en tant que nouvel utilisateur
                    $pdo = new \PDO("pgsql:host=db;port=5432;dbname=".$config["db_name"], $dbUser, $dbPassword);
                    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                    // Accorder tous les privilèges à l'utilisateur sur la base de données
                    $pdo->exec("GRANT ALL PRIVILEGES ON SCHEMA public TO ".$dbUser.";");
                    $pdo->exec("GRANT CREATE ON SCHEMA public TO ".$dbUser.";");
                    $pdo->exec("GRANT ALL PRIVILEGES ON DATABASE ".$config["db_name"]." TO ".$dbUser.";");

                    // Exécuter le script de création de table
                    $pdo->exec($createTableUser);
                    $pdo->exec($createTableMenu);
                
                } catch (PDOException $exception) {
                   $errors[] = "Erreur lors de la création de la base de données : ".$exception->getMessage();
                }
                
                $file = fopen($filename, "w");

                if ($file) {
                    fwrite($file, "<?php\n\n");
                    fwrite($file, "define('CONNECT', \"".$connect."\");\n");
                    fwrite($file, "define('DB_USER', \"".$config['db_username']."\");\n");
                    fwrite($file, "define('DB_PASSWORD', \"".$config['db_password']."\");\n");
                    fwrite($file, "define('PREFIX', \"".$config['table_prefix']."\");\n");
                    fwrite($file, "\$createDatabase = \"".$createDatabase."\";\n");
                    fwrite($file, "\$createTableUser = \"".$createTableUser."\";\n");
                    fwrite($file, "\$createTableMenu = \"".$createTableMenu."\";\n");
                    fclose($file);
                } else {
                    $errors[] = "Erreur lors de la création du fichier de configuration.";
                }

                // ===== Create user =====
                $user = new Users();
                $mail = new Mail();

                $user->setFirstname($_POST["site_username"]);
                $user->setLastname($_POST["site_username"]);
                $user->setEmail($_POST["site_email"]);
                $user->setPassword($_POST["site_password"]);
                $user->save();
                session_start();
                $_SESSION['email'] = $_POST["site_email"];
                $_SESSION['user_id'] = $user->getId();
                $mail = new Mail();
                $subject = "Verification de votre adresse e-mail";
                $message  ="
                <html>
                <body>
                <h1>Vérification de votre adresse e-mail</h1>
                <p>Pour valider votre adresse e-mail, veuillez cliquer sur le lien suivant : <a href='http://localhost/verify_email'>Valider mon adresse e-mail</a></p>
                </body>
                </html>
                ";
                $mail->sendMail($_REQUEST['email'], $message, $subject);
                exit;
            }
        }
        $view = new View("Installer/setup_site", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }
}