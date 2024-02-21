<?php

namespace App\Models;
use App\Core\DB;
class Pages extends DB {
    private int $id = null;
    private string $title;
    private string $html;
    private string $css;
    private string $js;
    private string $status;

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
    public function gettitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function settitle(string $title): void
    {
        $firstname = ucwords(strtolower(trim($title)));
        $this->title = $title;
    }

    /**
     * @return string $html
     */
    public function gethtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function sethtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return string $css
     */
    public function getcss(): string
    {
        return $this->css;
    }

    /**
     * @param string $css
     */
    public function setcss(string $css): void
    {
        $this->css = $css;
    }

    /**
     * @return string $js
     */
    public function getjs(): string
    {
        return $this->js;
    }

    /**
     * @param string $js
     */
    public function setjs(string $js): void
    {
        $this->js = $js;
    }

    /**
     * @return string $status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $status = strtoupper(trim($status));
        $this->status = $status;
    }
}