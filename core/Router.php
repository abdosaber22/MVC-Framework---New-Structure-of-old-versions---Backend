<?php

namespace app\core;
use app\config\Loader;

class Router {

  public Request $request;
	public Response $response;
	private $callback;
	protected array $routes = [];

 /**
  * @method constructor
  * @param Request $request
  * @param Response $response
  * Create instance of this classes in core folder to use it inside class
  */
	public function __construct(Request $request, Response $response)
	{
		$this->response   = $response;
		$this->request    = $request;
	}

 /**
  * @method get
  * @param string $path: '/', '/contact' like this
  * @param [string / array, callback function] $callback Accepts an string or function or array
  * To set route of something and what to get back
  */
  public function get($path, $callback) {
    $this->routes['get'][$path] = $callback;
  }

 /**
  * @method post
  * @param string $path: '/', '/contact' like this
  * @param [string / array, callback function] $callback Accepts an string or function or array
  * whenever post request is set to some route
  */
  public function post($path, $callback) {
    $this->routes['post'][$path] = $callback;
  }

 /**
  * @method resolve
  * This simply make the routing system of framework and make this class run
  */
  public function resolve()
  {
    $path = $this->request->getPath();
		$method = $this->request->getMethod();
		$callback = $this->routes[$method][$path] ?? false;
		if ($callback === false) {
			$this->response->responseCode(404);
			return $this->renderOnlyView("errors->404");
		}
	  if (is_array($callback)) {
		  Application::$app->controller = new $callback[0]();
		  $callback[0] = new Application::$app->controller;
	  } elseif (is_string($callback)) {
			return $this->renderView($callback);
		}
	  $this->callback = $callback;
	  return call_user_func($callback, $this->request, $this->response);
  }

 /**
  * @method renderView
  * @param string callback [ this accepts view name ]
  * @param array params [ To pass as variables to view page ]
  * Render selected view
  */
	public function renderView(string $callback, array $params = [])
	{
    $layoutContent = $this->layoutContent();
    $viewContent   = $this->renderOnlyView($callback, $params);

    return str_replace("{{content}}", $viewContent, $layoutContent);
    
	}
	
	public function changeTitle() {
		$layoutContent = $this->layoutContent();
		return str_replace("{{title}}", Application::$app->controller->__title, $layoutContent);
	}

 /**
  * @method layoutContent
  * Get Layout content
  */
  public function layoutContent() {
  	if (is_array($this->callback)) {
		  $layout = Application::$app->controller->layout ?? 'main';
		  ob_start();
		  include_once(Application::$root_dir . "/views/layouts/$layout.php");
		  $content = ob_get_clean();
		  return str_replace("{{title}}", Application::$app->controller->__title, $content);
	  } else {
		  ob_start();
		  include_once(Application::$root_dir . "/views/layouts/main.php");
		  $content = ob_get_clean();
		  return str_replace("{{title}}", Application::$app->controller->__title, $content);
	  }
   
  }

 /**
  * @method renderOnlyView
  * @param view Accepts view name
  * @param params Accepts params to pass to passed view
  */
  public function renderOnlyView($view, $params = [])
  {
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    $view = str_replace("->", '/', $view);
	  $this->load_framework();
	  include_once(Application::$root_dir . "/views/$view.php");
    return ob_get_clean();
  }
  
	public function load_framework() {
		$loader = new Loader();
		$loader->render();
	}

}
