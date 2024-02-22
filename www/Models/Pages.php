<?php

namespace App\Models;
use App\Core\DB;
class Pages extends DB {
    private ?int $id = null;
    protected string $title;
    protected string $html;
    protected string $css;
    protected string $js;
    protected string $path;
      
     /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $title = ucwords(strtolower(trim($title)));
        $this->title = $title;
    }

    /**
     * @return string $html
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return string $css
     */
    public function getCss(): string
    {
        return $this->css;
    }

    /**
     * @param string $css
     */
    public function setCss(string $css): void
    {
        $this->css = $css;
    }

    /**
     * @return string $js
     */
    public function getJs(): string
    {
        return $this->js;
    }

    /**
     * @param string $js
     */
    public function setJs(string $js): void
    {
        $this->js = $js;
    }

    /**
     * @return string $path
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $path = ucwords(strtolower(trim($path)));
        $this->path = $path;
    }
}