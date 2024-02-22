<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Pages;

class Page{
    public function createPage() : void {
        $page = new Pages();
        $postData = json_decode(file_get_contents('php://input'), true);
        $page->setTitle($postData['title']);
        $page->sethtml($postData['html']);
        $page->setCss($postData['css']);
        $page->setJs($postData['js']);
        $page->setPath($postData['path']);
        $page->save();
    
        echo json_encode(['success' => true, 'message' => 'Création de la page avec succès']);
    }    

    public function viewPage(string $path): void
    {   
        if (!empty($path)) {
            $page = new Pages();
            $pageData = $page->getOneBy(["path" => $path], "object");

            if ($pageData) {
                // Assigner les données de la page à la vue
                $view = new View("Main/page", "front");
                $view->assign("pageData", $pageData); // Assigner les données de la page à la clé "pageData"
            } else {
                echo "Page non trouvée";
            }
        } else {
            echo "Path non spécifié";
        }
    }
    public function deletePage() : void {}
}