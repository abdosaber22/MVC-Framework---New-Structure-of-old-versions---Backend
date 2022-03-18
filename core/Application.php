<?php

namespace app\core;
use app\config\Loader;
use app\helper\database\Database;
use app\helper\database\Table;

class Application
{

  public static string $root_dir;
  public Router $router;
  public Request $request;
  public Response $response;
  public static Application $app;
  public static Loader $loader;
  public static Connect $connect;
	public static Database $database;
	public static Table $table;
	public Session $session;
	public Controller $controller;

  public function __construct($rootPath) {
    self::$root_dir   = $rootPath;
	  self::$app        = $this;
	  self::$loader     = new Loader();
	  self::$table      = new Table();
	  self::$database   = new Database();
	  $connect          = new Connect();
	  self::$connect    = $connect;
	  $this->session    = new Session();
	  $this->request    = new Request();
	  $this->controller = new Controller();
	  $this->response   = new Response();
	  $this->router     = new Router($this->request, $this->response);
	  $connect->establish_connection();
  }
  
  public function run() {
    echo $this->router->resolve();
  }
  
}
