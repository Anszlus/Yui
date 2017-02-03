<?php
/*
 * Yui: The PHP micro-framework.
 * 
 * @copyright   Copyright (c) 2017, Piotr Nalepka <anszlus12@gmail.com>
 * @license     MIT
 */
class Yui
{
    protected $_router;
    protected $_callback;

    public function add($ar1, $ar2)
    {
        $this->_router[] = $ar1;
        $this->_callback[] = $ar2;
    }

    public function run()
    {
        $uri = $_GET['uri'] ?? '/';
        $UriIsSetInTheRouter = false;

        foreach($this->_router as $key => $value) {
            if(preg_match("#^$value$#", $uri, $params))
            {   
                $UriIsSetInTheRouter = true;
                array_shift($params);
                
                if(is_callable($this->_callback[$key]))
                    call_user_func_array($this->_callback[$key], $params);
                else
                {
                    require __DIR__ . '/../controllers/' . $this->_callback[$key] . '.php';
                    $o = new $this->_callback[$key]();
                    $o->index();
                }
            }
        }
        if (!$UriIsSetInTheRouter) {
            echo '<h1 style="color:#9E9E9E; text-align: center; margin-top: 35vh; margin-bottom: 0px; font-weight: 400; padding-bottom: 0; font-size:100px; font-family: serif; word-spacing: 2px; letter-spacing: 1px;">404</h1>
                <p style="color:#9E9E9E; font-size: 18px; clear: both; text-align: center; margin: 0; word-spacing: 2px; letter-spacing: 1px; font-family: serif;">Page Not Found</p>';
        }
    }
}