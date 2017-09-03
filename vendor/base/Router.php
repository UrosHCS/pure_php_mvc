<?php

namespace vendor\base;

/**
* Router class makes sure the right Controller is instantiated,
* and the right action (controller method) is called based on
* the url and request method.
*/
class Router {

	const CONTROLLERS_PATH = 'app\\controllers\\';

	/**
	 * An array of routes which is used to resolve the request path
	 */
	private $routes;

	/**
	 * An route used in the redirectHome() method
	 */
	private $homeRoute;

	/**
	 * The path part from the url
	 */
	private $path;

	/**
	 * The request method (GET, POST, ...)
	 */
	private $requestMethod;
	
	/**
	 * Setup a default route and default action on instantiation
	 */
	public function __construct(string $homeRoute, string $defaultAction) {
		$this->homeRoute = $homeRoute;
		$this->defaultAction = $defaultAction;
	}

	/**
	 * Sets the routes array from the routes.php
	 * script file that is passed as argument
	 */
	public function setRoutes(array $routes) {
		$this->routes = $routes;
	}

	/**
	 * Instantiates a certain controller and calls an action
	 * based on the $url and $requestMethod
	 * @param string $url the full url of the request
	 * @param string $requestMethod the request method (GET, POST, ...)
	 */
	public function handleRequest(string $url, string $requestMethod) {
		// parse url
		$this->path = parse_url($url)['path'];
		$this->requestMethod = $requestMethod;
		
		// resolve path
		$resolvedPath = $this->resolvePath();
		$resolvedController = $this->resolveController($resolvedPath[0]);
		$resolvedAction = $this->resolveAction($resolvedPath[1]);

		// Instantiate the controller and call the action.
		// The controller gets a reference to a View (to render views)
		// and to this router (to redirect)
		session_start();
		$controller = new $resolvedController(new View(), $this);
		$controller->$resolvedAction();
	}

	/**
	 * Returns an array with two elements. 
	 * The first element is the controller name,
	 * and the second element is the action name
	 * or an array in the form of requestMethod => actionName.
	 * 
	 * Or it redirects to home if the path cannot be resolved.
	 */
	private function resolvePath() {
		return $this->routes[$this->path] ?? $this->redirectHome();
	}

	/**
	 * Returns the full controller name.
	 * 
	 * Or it redirects to home if the controller class doesn't exist.
	 */
	private function resolveController(string $controllerClass) {
		$controllerFullName = self::CONTROLLERS_PATH . $controllerClass;
		if (class_exists($controllerFullName)) {
			return $controllerFullName;
		}
		$query = '?message=controller_class_does_not_exist';
		$this->redirectHome($query);
	}

	/**
	 * Returns the action name.
	 * 
	 * Or it redirects to home if the action cannot be resolved.
	 */
	private function resolveAction($action) {
		if (is_array($action)) {
			$action = $action[$this->requestMethod];
		}
		if (is_string($action)) {
			return $action;
		}
		$query = '?message=controller_action_unresolved';
		$this->redirectHome($query);
	}

	/**
	 * Redirects to $path with $query as query
	 */
	public function redirect(string $path, string $query = '') {
		$domain = filter_input(INPUT_SERVER, 'SERVER_NAME');
		header('Location: http://' . $domain . $path . $query);
		exit();
	}

	/**
	 * Redirects to the default route with $query as query
	 */
	public function redirectHome(string $query = '') {
		$this->redirect($this->homeRoute, $query);
	}

	/**
	 * Redirects to the default route with an error message in query
	 */
	public function redirectHomeWithError() {
		$this->redirect($this->homeRoute, '?message=error');
	}

	/**
	 * Redirects to the login page with $query in query
	 */
	public function redirectLogin(string $query = '') {
		$this->redirect('/login', $query);
	}
}