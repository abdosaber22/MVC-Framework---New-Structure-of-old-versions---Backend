<?php
return [
	'DB_HOST' => 'localhost',
	'DB_USER' => 'root',
	'DB_NAME' => 'shop',
	'DB_PASSWORD' => '',
	'DB_CONNECTION' => 'mysql',
	'CREATE_CONNECTION' => true,
	'DB_CONNECTION_OPTIONS' => [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	]
];