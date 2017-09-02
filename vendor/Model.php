<?php

namespace vendor;

use vendor\base\DB;
/**
* 
*/
abstract class Model {

	protected abstract function tableName();

	protected function beforeSave() {

	}

	/**
	* Saves the instance of the Model in the database
	*/
	public function save() {
		$this->beforeSave();
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

	public static function findAll(string $preparedCondition = '', array $preparedValues = []) {
		$model = new static();
		$statement = DB::getInstance()->selectAll($model->tableName(), $preparedCondition, $preparedValues);
		return $statement->fetchAll(DB::getInstance()->fetchClass(), get_class($model));
	}

	public static function find(int $id) {
		$model = new static();
		$statement = DB::getInstance()->selectById($model->tableName(), $id);
		$models = $statement->fetchAll(DB::getInstance()->fetchClass(), get_class($model));
		return $models[0];
	}

	/**
	 * This function is flexible but it was made to check if username is unique
	 * @return boolean true if $propertyValue not in $columnName column values
	 */
	public function isUnique(string $properyValue, $columnName) {
		$values = DB::getInstance()->select($this->tableName(), [$columnName])
			->fetchAll(DB::getInstance()->fetchColumn(), 0);

		return !in_array($properyValue, $values);
	}
}
