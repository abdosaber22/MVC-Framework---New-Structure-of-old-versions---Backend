<?php


namespace app\config;
use app\core\Application;


class Assets
{
	public static function load($type) {
		$type = strtolower($type);
		
		$files = Application::$loader->config('LAYOUT')[$type];
		

		if ($type === 'css') {
			foreach (glob($files) as $key => $file) {
				echo "<link rel='stylesheet' href='$file'>";
			}
		} elseif ($type === 'js') {
			foreach (glob($files) as $key => $file) {
				echo "<script src='$file'></script>";
			}
		}
		
	}
}