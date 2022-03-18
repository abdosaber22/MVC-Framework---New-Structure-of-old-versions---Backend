<?php
namespace app\core;

class Session {
	
	protected const FLASH_KEY = 'flash_messages';
	
	public function __construct() {
		session_start();
		$flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
		foreach ($flashMessages as $key => &$flashMessage) {
			$flashMessage['removed'] = true;
		}
		$_SESSION[self::FLASH_KEY] = $flashMessages;
		

	}
	
	public static function add($name, $value) {
		$_SESSION[$name] = $value;
	}
	
	public function setFlash($key, $message) {
		$_SESSION[self::FLASH_KEY][$key] = [
			'removed' => false,
			'value' => $message
		];
	}
	
	public function getFlash($key) {
		return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
	}
	
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	public function get($key) {
		return $_SESSION[$key];
	}
	
	public function rm_session($key) {
		unset($_SESSION[$key]);
	}
	
	public function session_exists($key) {
		return (isset($_SESSION[$key]) ? true : false);
	}
	
	public function __destruct()
	{
		$flash_messages = $_SESSION[self::FLASH_KEY] ?? [];
		foreach ($flash_messages as $key => &$flash_message) {
			if ($flash_message['removed']) {
				unset($flash_messages[$key]);
			}
		}
		
		$_SESSION[self::FLASH_KEY] = $flash_messages;
		
	}
	
}