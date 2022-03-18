<?php

return [
	'APP_NAME' => 'Shopping',
	'APP_URL' => 'http://localhost',
	'LOAD_FRAMEWORK' => true,
	'REQUIRED_FILES' => [
		'functions' => '../helper/functions/*.php',
		'database' => '../helper/database/*.php',
		'file_sys' => '../helper/file_system/*.php',
	],
	'DEBUG_MODE'  => false,
	'LOCAL_LANG'  => 'en',
	'TIME_ZONE'   => 'UTC',
	'ALLOW_PACKAGES' => true,
	'PACKAGES'  => [
		'helper/packages/pack_name/'
	],
	'LAYOUT'  => [
		'css' => '../public/assets/css/*.css',
		'js' => 'assets/js/*.js',
	],
];