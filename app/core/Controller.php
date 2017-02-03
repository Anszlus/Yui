<?php

abstract class Controller
{
    public function __construct() {}

    public function redirect($url)
    {
        header('location: ' . $url);
    }

    public function loadView($name)
    {
        $path = APP_PATH . 'views/' . strtolower($name) . '.php';

        try {
            if(is_file($path)){
                require $path;
                $view = new $name();
            }
            else
                throw new Exception('Can\'t open view '.$name.' in: ' . $path);
        }
        catch(Exception $e) {
            echo '<fieldset><legend>' . $e->getMessage() . '</legend><code>
                <b>File:</b> ' . $e->getFile() . '::' . $e->getLine() . '<br>
                <b>Trace:</b> <pre>' . $e->getTraceAsString() . '</pre></code></fieldset>';
            exit;
        }

        return $view;
    }
    
    public function loadModel($name)
    {
        $path = APP_PATH . 'models/' . strtolower($name) . '.php';
        
        try {
            if(is_file($path)) {
                require $path;
                $model = new $name();
            }
            else
                throw new Exception('Can\'t open model '.$name.' in: '.$path);
        }
        catch(Exception $e) {
            echo '<fieldset><legend>' . $e->getMessage() . '</legend><code>
                <b>File:</b> ' . $e->getFile() . '::' . $e->getLine() . '<br>
                <b>Trace:</b> <pre>' . $e->getTraceAsString() . '</pre></code></fieldset>';
            exit;
        }

        return $model;
    }

}