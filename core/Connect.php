<?php

namespace app\core;
use app\config\Loader;

class Connect
{
	
	private string $DB_USER;
	private string $DB_HOST;
	private string $DB_PASSWORD;
	private string $DB_NAME;
	private array $DB_OPTIONS;
	private string $dsn;
	public static $pdo;
	
	public string $created_at;
	
	public Loader $loader;
	
	public function __construct()
	{
		$this->loader = Application::$loader;
		$this->DB_USER = $this->loader->config('DB_USER', 'db');
		$this->DB_PASSWORD = $this->loader->config('DB_PASSWORD', 'db');
		$this->DB_HOST = $this->loader->config('DB_HOST', 'db');
		$this->DB_NAME = $this->loader->config('DB_NAME', 'db');
		$this->DB_OPTIONS = $this->loader->config('DB_CONNECTION_OPTIONS', 'db');
		$this->dsn = "mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME;
		
		
	}
	
	public function establish_connection() {
		if ($this->loader->config('CREATE_CONNECTION', 'db')) {
			try {
				$pdo = new \PDO($this->dsn, $this->DB_USER, $this->DB_PASSWORD, $this->DB_OPTIONS);
				self::$pdo = $pdo;
			} catch (\ErrorException $e) {
				echo $e->getMessage();
			}
		} else {
			echo "\n Note:: You're trying to create connection with your database.. but it's disabled from configurations please change it to <strong><code>true</code></strong>\n";
			exit;
		}
	}
	
}