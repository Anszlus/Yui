<?php

class welcome extends View
{
    
    public function __construct() {}

    public function index()
    {
        $this->render('welcome');
    }
}