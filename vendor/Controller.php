<?php

namespace vendor;

use vendor\base\View;
use vendor\base\Router;

/**
* Base Controller class
*/
abstract class Controller {

	/**
	* Reference to a View class
	*/
	private $view;

	/**
	* Reference to a View class
	*/
	private $router;
	
	public function __construct(View $view, Router $router) {
		$this->view = $view;
		$this->router = $router;
	}

	/**************************************************
	 * Helper functions for rendering and redirecting *
	 **************************************************/

	/*
	 * Renders a view file
	 */
	protected function render(string $file, array $vars = []) {
		$this->view->render($file, $vars);
	}

	/*
	 * Redirects to the $path with $query in query
	 */
	protected function redirect(string $path, string $query = '') {
		$this->router->redirect($path, $query);
	}

	/*
	 * Redirects to the home page with $query in query
	 */
	protected function redirectHome($query = '') {
		$this->router->redirectHome($query);
	}

	/*
	 * Redirects to the login page with $query in query
	 */
	protected function redirectLogin(string $query = '?message=redirected') {
		$this->router->redirectLogin($query);
	}

}
