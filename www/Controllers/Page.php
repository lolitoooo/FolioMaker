<?php
namespace App\Controllers;

use App\Models\Pages;

class Page{
    public function createPage() : void {
        $page = new Pages();
    }
    public function viewPage() : void {}
    public function updatePage() : void {}
    public function deletePage() : void {}
}