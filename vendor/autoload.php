<?php

/*******************
 * 
 * The app starts here
 *
********************/

define('REAL_ROOT', dirname($_SERVER["DOCUMENT_ROOT"]));

set_include_path(get_include_path() . PATH_SEPARATOR . realpath('..'));

spl_autoload_register(function ($class) {
        $filename = REAL_ROOT . '/' . str_replace("\\", '/', $class) . ".php";
        if (file_exists($filename)) {
        	require_once $filename;
            if (class_exists($filename)) {
                return TRUE;
            }
        }
        return FALSE;
});


$webApplication = new vendor\base\Application();

$webApplication->start();