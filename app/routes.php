<?php

/*
 * This is where the routes should be registered.
 * 
 * Example if the route recieves only GET requests:
 * '/path' => ['SomeController', 'methodName']
 * 
 * Example if the route recieves other than GET requests:
 * '/path' => ['SomeController', [
 * 			'GET' => 'methodOne',
 * 			'POST' => 'methodTwo',
 * 			'DELETE' => 'methodThree',
 * 		]
 * ]
 * 
 */

$homeController = 'HomeController';

$routes = [
	'/' => [$homeController, 'home'],
	'/home' => [$homeController, 'home'],
	'/login' => [$homeController, [
			'GET' => 'loginPage',
			'POST' => 'login',
		]
	],
	'/register' => [$homeController, [
			'GET' => 'loginPage',
			'POST' => 'register',
		]
	],
	'/logout' => [$homeController, 'logout'],
	'/users' => ['UserController', 'all'],
	'/test' => [$homeController, 'test'],
];

return $routes;