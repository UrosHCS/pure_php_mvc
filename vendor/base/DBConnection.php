<?php

namespace vendor\base;

use PDO;

/**
* Connection class that uses PDO to connect to the database.
* Every query is executed by prepare an execute methods to prevent SQL injection.
*/
class DBConnection {

	private $conn;

	public function __construct() {
		$this->conn = $this->getConnection();
	}

	protected function getConnection() {
		$dbConfig = APP_CONFIG['db'];
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		return new PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password'], $pdo_options);
	}

	/**
	 * Every method in this class ends up calling this method.
	 * Only this method executes queries in the database.
	 */
	public function query(string $preparedQuery, array $preparedValues, bool $insertingValues = false) {
		$statement = $this->conn->prepare($preparedQuery);
		$success = $statement->execute($preparedValues);
		
		if ($insertingValues) {
			return $success;
		}
		return $statement;
	}

	/**
	 * Base method for executing SELECT queries.
	 */
	public function select(string $tableName, array $columns, 
		string $preparedCondition = '', array $preparedValues = []) {

		$columns = implode(', ', $columns);

		if ($preparedCondition !== '') {
			$preparedCondition = ' WHERE ' . $preparedCondition;
		}
		$preparedQuery = "SELECT {$columns} FROM {$tableName}{$preparedCondition};";

		return $this->query($preparedQuery, $preparedValues);
	}

	public function selectAll(string $tableName, string $preparedCondition = '', array $preparedValues = []) {
		return $this->select($tableName, ['*'], $preparedCondition, $preparedValues);
	}

	public function selectById(string $tableName, int $id) {
		$preparedCondition = 'id = :id';
		$preparedValues = [':id' => $id];
		return $this->select($tableName, ['*'], $preparedCondition, $preparedValues);
	}

	/**
	 * Base method for executing INSERT queries.
	 */
	public function insertInto(string $tableName, array $data) {
		$columns = implode(', ', array_keys($data));

		$preparedData = $this->prepareData(':', $data);
		$preparedColumns = implode(', ', array_keys($preparedData));

		$preparedQuery = "INSERT INTO {$tableName} ({$columns}) VALUES ({$preparedColumns});";

		$insertingValues = true;
		return $this->query($preparedQuery, $preparedData, $insertingValues);
	}

	/** 
	 * Add a prefix before every key.
	 */
	private function prepareData($prefix, $data) {
		$preparedData = [];
		foreach ($data as $key => $value) {
		    $preparedData[$prefix . $key] = $value;
		}
		return $preparedData;
	}

	/**
	 * This method exists so that the Model class
	 * doesn't need to acces PDO class directly.
	 */
	public function fetchClass() {
		return PDO::FETCH_CLASS;
	}	

	/**
	 * This method exists so that the Auth class
	 * doesn't need to acces PDO class directly.
	 */
	public function fetchColumn() {
		return PDO::FETCH_COLUMN;
	}
}