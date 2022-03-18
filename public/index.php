<?php

  require '../vendor/autoload.php';
	
	use app\core\Application;
	use app\core\http\controllers\AuthController;
	use app\core\http\controllers\SiteController;
  
  $app = new Application(dirname(__DIR__));

	require '../helper/include.php';
 
	$app->router->get("/framework/", [SiteController::class, 'index']);
	$app->router->get("/framework/login", [AuthController::class, 'login']);
	$app->router->post("/framework/login", [AuthController::class, 'login']);
	$app->router->get("/framework/profile", [AuthController::class, 'profile']);
	$app->router->get("/framework/profile/update", [AuthController::class, 'update']);
	$app->router->post("/framework/profile/update", [AuthController::class, 'update']);
	$app->router->get("/framework/profile/logout", [AuthController::class, 'logout']);
	$app->router->get("/framework/register", [AuthController::class, 'register']);
	$app->router->post("/framework/register", [AuthController::class, 'register']);
	
  $app->run();


