<?php


/*******************
 * 
 * The app starts here
 *
********************/

set_include_path(get_include_path() . PATH_SEPARATOR . realpath('..'));

spl_autoload_register();

$webApplication = new vendor\base\Application();

$webApplication->start();