<?php

namespace vendor\base;

/**
* Application class, instantiated in index.php and called the start() method.
*/
class Application {

	public function start() {
		// Get all routes that we are handling
		$router = new Router('/home', 'home');
		$routes = require_once __DIR__ . '/../../app/routes.php';
		$router->setRoutes($routes);

		// Get the REQUEST_URL and REQUEST_METHOD
		$url = $this->getRequestUrl();
		$method = $this->getRequestMethod();

		// Handle the request
		$router->handleRequest($url, $method);
	}

	private function getRequestMethod() {
		return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
	}

	private function getRequestUrl() {
		return filter_input(INPUT_SERVER, 'REQUEST_URI');
	}
}