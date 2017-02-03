<?php

abstract class View
{
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

    public function render($name) {
        $path = APP_PATH . "resources/";
        $path = $path . $name . '.html.php';
        try {
            if(is_file($path))
                require $path;
            else {
                throw new \Exception('Can\'t open template ' . $name . ' in: ' . $path);
            }
        }
        catch(Exception $e) {
            echo '<fieldset><legend>' . $e->getMessage() . '</legend><code>
                <b>File:</b> ' . $e->getFile() . '::' . $e->getLine() . '<br>
                <b>Trace:</b> <pre>' . $e->getTraceAsString() . '</pre></code></fieldset>';
            exit;
        }
    }
    
    public function set($name, $value) {
        return $this->$name = $value;
    }

    public function get($name) {
        return $this->$name;
    }
}