<?php

namespace app\controllers;

use vendor\Controller;
use vendor\base\DB;
use vendor\base\Auth;
use app\models\User;
/**
 * 
 */
class HomeController extends Controller
{

	/**
	 * GET request to /home or /
	 */
	public function home() {
		if (Auth::isLoggedIn()) {
			$this->render('home');
		} else {
			$this->redirectLogin();
		}
		
	}

	/**
	 * GET request to /login
	 */
	public function loginPage() {
		if (Auth::isLoggedIn()) {
			$this->redirectHome();
		} else {
			$this->render('login');
		}
		
	}

	/**
	 * POST request to /login
	 */
	public function login() {
		if (Auth::isLoggedIn()) {
			Auth::logout();
		}
		$user = new User();
		$user->username = filter_input(INPUT_POST, 'username');
		$user->password = filter_input(INPUT_POST, 'password');
		if ($user->validate() && $user->login()) {
			$this->render('home');
			return;
		} 
		$error = 'Please recheck your username and password...';
		$this->render('login', [
			'user' => $user,
			'error' => $error,
		]);
		
	}

	/**
	 * POST request to /register
	 */
	public function register() {
		if (Auth::isLoggedIn()) {
			Auth::logout();
		}
		$user = new User();
		$user->username = filter_input(INPUT_POST, 'username');
		$user->password = filter_input(INPUT_POST, 'password');

		$confirmPass = filter_input(INPUT_POST, 'confirm');

		$error = '';
		if (!$user->validate($confirmPass)) {
			$error = 'Please recheck your username and password...';
		} elseif (!$user->uniqueUsername()) {
			$error = 'Username taken. Try NoobSlayer123.';
		} elseif (!$user->save()) {
			$error = 'Registered but failed to log in...';
		} elseif (!$user->login()) {
			$error = 'Couln\'t login after succesfull registration. This shuldn\'t happen.';
		}
		if ($error !== '') {
			$this->render('login', [
				'user' => $user,
				'error' => $error,
			]);
		} else {
			$this->render('home', ['user' => $user]);
		}
	}

	/**
	 * GET request to /logout
	 */
	public function logout() {
		Auth::logout();
		$this->redirectHome();
	}
}