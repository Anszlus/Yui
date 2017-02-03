<?php

class WelcomeController extends Controller
{
    public function index()
    {
        $view = $this->loadView('welcome');
        $view->index();
    }
}