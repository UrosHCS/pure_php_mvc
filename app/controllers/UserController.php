<?php

namespace app\controllers;

use vendor\Controller;
use vendor\base\Auth;
use app\models\User;

class UserController extends Controller
{

	public function all() {
		if (Auth::isLoggedIn()) {
			$users = User::findAll('ORDER BY created_at ASC');
			$this->render('users', ['users' => $users]);
		} else {
			$this->redirectLogin();
		}
		
	}
}