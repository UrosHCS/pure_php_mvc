<?php

namespace vendor;

use vendor\base\DB;
/**
* 
*/
abstract class Model {

	/**
	* Every model that extends this class must state a table name
	* by overriding this method and returning a string table name.
	*/
	protected abstract function tableName();

	/**
	* Saves the instance of the Model in the database
	* @return boolean save success
	*/
	public function save() {
		return DB::getInstance()->insertInto($this->tableName(), $this->getNotNullAttributes());
	}

	protected function getNotNullAttributes() {
		$object_vars = get_object_vars($this);
		foreach ($object_vars as $key => $value) {
			if ($value === null) {
				unset($object_vars[$key]);
			} elseif ($key === 'password') {
				$object_vars[$key] = password_hash($object_vars[$key], PASSWORD_DEFAULT);
			}
		}
		return $object_vars;
	}

	/**
	* Find all models within the WHERE clause that is specified by the two attributes
	* @param string $preparedCondition a prepared sql condition
	* @param string $preparedValues values to insert in the $preparedCondition
	* @return array model instances that match the condition
	*/
	public static function findAll(string $preparedCondition = '', array $preparedValues = []) {
		$model = new static();
		$statement = DB::getInstance()->selectAll($model->tableName(), $preparedCondition, $preparedValues);
		return $statement->fetchAll(DB::getInstance()->fetchClass(), get_class($model));
	}

	/**
	* Find a model by it's id in the database
	* @param int $id
	* @return Model instance that matches the condition "WHERE id = $id"
	*/
	public static function findById(int $id) {
		$model = new static();
		$statement = DB::getInstance()->selectById($model->tableName(), $id);
		$models = $statement->fetchAll(DB::getInstance()->fetchClass(), get_class($model));
		return $models[0];
	}

	/**
	 * This function is flexible but it was made to check if username is unique
	 * @param string $properyValue the value of the property to test
	 * @param string $columnName the name of the column to search in
	 * @return boolean true if $propertyValue not in $columnName column values
	 */
	public function isUnique(string $properyValue, string $columnName) {
		$values = DB::getInstance()->select($this->tableName(), [$columnName])
			->fetchAll(DB::getInstance()->fetchColumn(), 0);

		return !in_array($properyValue, $values);
	}
}
