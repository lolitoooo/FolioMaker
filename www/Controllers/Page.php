<?php
namespace App\Controllers;

use App\Models\Pages;

class Page{
    public function createPage() : void {
        $postData = json_decode(file_get_contents('php://input'), true);
        $page = new Pages();
        $page->setTitle();
        $page->sethtml();
        $page->setCss();
        $page->setJs();
        $page->setStatus();

    }
    public function viewPage() : void {}
    public function updatePage() : void {}
    public function deletePage() : void {}
}