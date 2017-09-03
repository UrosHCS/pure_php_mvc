<?php

namespace vendor\base;

/**
* Static methods for authentication and sessions
*/
class Auth {

	const USER_ID = 'user_id';
	const USERNAME = 'username';

	public static function isLoggedIn() {
		if (!isset($_SESSION[self::USER_ID]) && !isset($_SESSION[self::USERNAME])) {
			return false;
		}
		$ids = DB::getInstance()->select('user', ['id'])
			->fetchAll(DB::getInstance()->fetchColumn(), 0);
		
		return in_array($_SESSION[self::USER_ID], $ids);
	}

	public static function login($model) {
		session_regenerate_id();
		$_SESSION[self::USER_ID] = $model->id;
		$_SESSION[self::USERNAME] = $model->username;
	}

	public static function logout() {
		unset($_SESSION[self::USER_ID]);
		unset($_SESSION[self::USERNAME]);
		session_destroy();
	}

	public static function username() {
		return $_SESSION[self::USERNAME];
	}
}