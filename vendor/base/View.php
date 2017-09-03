<?php

namespace vendor\base;


/**
* View class that 
*/
class View {

	const VIEWS_PATH = __DIR__ . '/../../app/views/';

	/**
	* Content that goes into the layouts/main.php
	*/
	private $content;

	/**
	* CSS links for the header in the layouts/main.php
	*/
	private $cssLinks = '';

	/**
	* Script tags with src property for the end of the html body
	*/
	private $scripts = '';

	/**
	 * Renders a view file.
	 * @param string $file - name of the file in app/resources folder
	 * without the .php extension (only renders )
	 * @param array $vars - the variables to be used in the view
	 */
	public function render(string $file, array $vars = []) {

		if ($vars !== []) {
			extract($vars, EXTR_OVERWRITE);
		}

		$isLoggedIn = Auth::isLoggedIn();

		ob_start();
		require_once static::VIEWS_PATH . $file . '.php';
		$this->content = ob_get_clean();

		ob_start();
		require_once static::VIEWS_PATH . 'layouts/main.php';
		$html = ob_get_clean();

		echo $html;
		exit; // End app manually just in case;
	}

	public function authUsername() {
		return Auth::username();
	}

	/**
	 * Inserts a CSS link tag to html head.
	 * @param string $href - path to file from public/css dir
	 */
	public function registerCSS(string $relativePath) {
		$this->cssLinks .= '<link rel="stylesheet" href="/css/' . $relativePath . '">';
	}

	/**
	 * Inserts a script tag to html body end.
	 * @param string $href - path to file from public/js dir
	 */
	public function registerScript(string $relativePath) {
		$this->scripts .= '<script src="/js/' . $relativePath . '"></script>';
	}

}
