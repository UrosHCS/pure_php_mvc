<?php

namespace vendor\base;


/**
* View class that 
*/
class View {

	/**
	* Content that goes in the layouts/main.php
	*/
	private $content;

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
		require_once $this->relativePathToViews() . $file . '.php';
		$this->content = ob_get_contents();
		ob_end_clean();

		ob_start();
		require_once $this->relativePathToViews() . 'layouts/main.php';
		$html = ob_get_contents();
		ob_end_clean();

		echo $html;
		exit; // End app manually just in case;
	}

	protected function relativePathToViews() {
		return __DIR__ . '/../../app/views/';
	}

}
