<?php

namespace app\models;

use vendor\Model;
use vendor\base\Auth;
use vendor\interfaces\Identity;

class User extends Model implements Identity
{
	public $id;
	public $username;
	public $password;
	public $passwordHash;
	public $created_at;
	public $updated_at;

	protected function tableName() {
		return 'user';
	}

	public function validate(string $confirmPassword = null) {
		$validated = true;
		$u = $this->username;
		$p = $this->password;
		if (strlen($u) < 4 || strlen($u) > 40) {
			$validated = false;
		}
		if (strlen($p) < 4 || strlen($p) > 40) {
			$validated = false;
		}
		if ($confirmPassword !== null) {
			if ($confirmPassword !== $p) {
				$validated = false;
			}
		}
		return $validated;
	}

	public function uniqueUsername() {
		return $this->isUnique($this->username, 'username');
	}

	public function login() {
		if ($this->authenticate()) {
			Auth::login($this);
			return true;
		}
		return false;

	}

	public function authenticate() {
		$preparedCondition = 'username = :username';
		$preparedValues = [':username' => $this->username];

		$userArr = static::findAll($preparedCondition, $preparedValues);

		//$isAuth = !empty($userArr);

		if (!empty($userArr)) {
			$user = $userArr[0];
			if (password_verify($this->password, $user->password)) {
				// We need to set the id for session purposes
				$this->id = $userArr[0]->id;
				return true;
			}
		}
		return false;
	}
	
}