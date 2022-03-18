<?php

use app\config\Loader;
use app\core\Application;

if (Application::$loader->config('LOAD_FRAMEWORK')) {
	$files = Application::$loader->config('REQUIRED_FILES');
	foreach ($files  as $key => $value) {
		foreach (glob($value) as $file) {
			include_once($file);
		}
	}
} else {
	echo "<div><strong>Note:</strong> Framework files loader is disabled from configurations please change it to <strong><code>true</code></strong> </div>";
}