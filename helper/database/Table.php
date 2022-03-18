<?php
namespace app\helper\database;

use app\core\Application;
use app\core\Connect;
use function app\helper\functions\config;

class Table {

	public static $pdo;
	
	public function __construct() {
		self::$pdo = Connect::$pdo;
	}
	
	public static function findOne($table, $col, $value, $return_what = "data") {
		$stmt = self::$pdo->prepare("SELECT * FROM $table WHERE $col = $value");
		$stmt->execute();
		if ($return_what === 'data') {
			return $stmt->fetch();
		} elseif ($return_what === 'row-count') {
			return $stmt->rowCount();
		}
	}
	
	public static function findManyAND($where, $table, $return = 'data') {
		$attributes = array_keys($where);
		$Sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr ", $attributes));
		
		$stmt = self::$pdo->prepare("SELECT * FROM `{$table}` WHERE $Sql");
		foreach ($where as $i => $item) {
			$stmt->bindValue(":$i", $item);
		}
		$stmt->execute();
		if ($return === 'data') {
			return $stmt->fetchObject(static::class);
		} elseif ($return === 'result') {
			return $stmt->rowCount();
		}
	}
	
	public static function findManyOR($where, $table, $return = 'data') {
		$attributes = array_keys($where);
		$Sql = implode("OR ", array_map(fn($attr) => "$attr = :$attr ", $attributes));
		
		$stmt = self::$pdo->prepare("SELECT * FROM `{$table}` WHERE $Sql");
		foreach ($where as $i => $item) {
			$stmt->bindValue(":$i", $item);
		}
		$stmt->execute();
		if ($return === 'data') {
			return $stmt->fetchObject(static::class);
		} elseif ($return === 'result') {
			return $stmt->rowCount();
		}
	}
	
	
	
	public static function run($statement, $return_what = 'row-count') {
		$st = self::$pdo->prepare($statement);
		$st->execute();
		if ($return_what === 'data-one') {
			return $st->fetch();
		} elseif ($return_what === 'data-all') {
			return $st->fetchAll();
		} elseif ($return_what === 'row-count') {
			return $st->rowCount();
		}
	}
	
	public function getTableData($tbl) {
		$stmt = self::$pdo->prepare("SELECT * FROM $tbl");
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	public function getLast($tbl, $order_by = 'id') {
		$stmt = self::$pdo->prepare("SELECT * FROM $tbl ORDER BY $order_by DESC LIMIT 1");
		$stmt->execute();
		return $stmt->fetch();
	}
	
	public function getFirst($tbl, $order_by = 'id') {
		$stmt = self::$pdo->prepare("SELECT * FROM $tbl ORDER BY $order_by ASC LIMIT 1");
		$stmt->execute();
		return $stmt->fetch();
	}
	
	public function update($new_values, $tbl, $w, $value)
	{
		$stmt = self::$pdo->prepare("UPDATE $tbl SET $new_values WHERE $w = $value");
		$stmt->execute();
		return $stmt->rowCount();
	}
	
	public function save($table, $data, $values) {
		$table_name = $table;
		$statement = self::$pdo->prepare("INSERT INTO `$table_name`($data) VALUES($values)");
		$statement->execute();
		return $statement->fetchObject(static::class);
	}
	
}
