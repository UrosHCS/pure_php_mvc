<?php 

/*
 * Mini MVC app
 * by Uroš Anđelić
 */

define('APP_ROUTES', require_once __DIR__ . '/app/routes.php');
define('APP_CONFIG', require_once __DIR__ . '/app/config.php');
define('APP_RESOURCES', __DIR__ . '/app/resources/');

spl_autoload_register();

$webApplication = new vendor\base\Application();

$webApplication->start();

// To do
// Auth with sessions and hashing password
// Optimize View->render