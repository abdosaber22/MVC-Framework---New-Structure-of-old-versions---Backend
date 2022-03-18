<?php

namespace app\core;

class Controller {

  public string $layout = 'main';
  
  public string $__title;
  
  public function __construct() {
	  $this->__title = Application::$loader->config('APP_NAME');
  }

  public function setLayout($layout = 'main') {
    $this->layout = $layout;
  }
	public function setTitle($title) {
		$this->__title = $title;
	}

  public function render($view, $params = []) {
    return Application::$app->router->renderView($view, $params);
  }
  
  public static function view($view, $params = []) {
	  return Application::$app->router->renderView($view, $params);
  }


}
