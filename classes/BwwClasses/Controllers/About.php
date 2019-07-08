<?php
namespace BwwClasses\Controllers;

class About
{
    public function __construct()
    {
    }

    public function render()
    {
        return [
            'template' => 'about.html.php',
            'title' => 'About'
        ];
    }
}