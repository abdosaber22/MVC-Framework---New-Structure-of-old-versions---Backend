<?php
namespace app\core\form;
use app\core\Model;

class Form
{
	public static function begin($method = 'POST', $action = '', $classes = '')
	{
		echo sprintf("<form method='%s' class='%s' action='%s'>", $method, $classes, $action);
		return new Form();
	}
	
	public static function end()
	{
		echo sprintf("</form>");
	}
	
	public function field(Model $model, $attribute)
	{
		return new Field($model, $attribute);
	}
	
	
}