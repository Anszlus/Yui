<?php

abstract class Model
{
    protected $pdo;

    public function  __construct()
    {
        try {
            require APP_PATH . 'core/ConfigDB.php';
            $this->pdo = new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['username'], $db['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(DBException $e) {
            echo 'The connect can not create: ' . $e->getMessage();
            die();
        }
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

    public function DBquery($query)
    {
        $method = $query[0];
 
        if ($method == 's' || $method == 'S')
            return $this->pdo->query($query);
        else
            return $this->pdo->exec($query);
    }

}