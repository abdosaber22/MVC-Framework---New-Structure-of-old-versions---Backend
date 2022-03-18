<?php
namespace app\helper\database;

use app\core\Application;
use app\core\Connect;
use function app\helper\functions\config;

class Database {
	
	public static $pdo;
	
	public function __construct() {
		self::$pdo = Connect::$pdo;
	}
	
	public static function dropTable($table) {
		return self::$pdo->exec("DROP TABLE IF EXISTS `$table`");
	}
	
	public static function dropDatabase($DB) {
		return self::$pdo->exec("DROP DATABASE IF EXISTS `$DB`;");
	}
	
	public static function createDatabase($database) {
		return  self::$pdo->exec("CREATE DATABASE IF NOT EXISTS `$database`");
	}
	
	
}
