<?php
namespace app\config;
use app\core\Application;

class Loader
{
	
	private $config_db;
	private $config_web;
	
	function __construct()
	{
		$this->config_db  = require(Application::$root_dir . '/config/db.php');
		$this->config_web = require(Application::$root_dir . '/config/website.php');
	}
	
	public function config($data, $def = 'app') {
		$config_db    = $this->config_db;
		$config_web  = $this->config_web;
		if ($def === 'app') {
			return $config_web[$data];
		} elseif ($def === 'db') {
			return $config_db[$data];
		} else {
			return false;
		}
	}
	
	public function render() {
		$files = $this->config('REQUIRED_FILES');
		if ($this->config('LOAD_FRAMEWORK')) {
			foreach ($files  as $key => $value) {
				foreach (glob($value) as $file) {
					include_once($file);
				}
			}
		} else {
			echo "<div><strong>Note:</strong> Framework files loader is disabled from configurations please change it to <strong><code>true</code></strong> </div>";
		}
		
	}
	

}