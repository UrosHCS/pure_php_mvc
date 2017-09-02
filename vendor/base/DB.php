<?php

namespace vendor\base;

/**
* Just a singleton that returns a DBConnection object
*/
class DB {

	private static $connection;
	
	private function __construct() {}

	private function __clone() {}

	public static function getInstance() {
		if (!isset(self::$connection)) {
			self::$connection = new DBConnection();
		}
		return self::$connection;
	}
}