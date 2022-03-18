<?php

namespace app\core\http\controllers;
use app\core\Controller;
use app\core\http\models\User;
use app\core\Request;
use app\core\Response;
use app\helper\database\Database;
use app\helper\database\Table;

class SiteController extends Controller {
	
	public string $layout;
	
	public function index() {
		echo $this->render("home");
	}
	
}