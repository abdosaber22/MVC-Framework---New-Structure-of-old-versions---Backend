<?php
namespace app\core\form;

use app\core\Model;

class Field {
	
	public const TYPE_TEXT = 'text';
	public const TYPE_PASSWORD = 'password';
	public const TYPE_NUMBER = 'number';
	
	public string $type;
	public Model $model;
	public string $attribute;
	public string $password_value;
	
	public function __construct($model, $attr)
	{
		$this->model = $model;
		$this->attribute = $attr;
		$this->type = self::TYPE_TEXT;
	}
	
	public function __toString() {
		return sprintf("
			<div class='mb-3 col'>
      <label class='form-label'>%s</label>
      <input type='%s' name='%s' class='form-control%s' value='%s' placeholder='%s'>
      <div class='invalid-feedback'>%s</div>
    	<small class='form-text text-muted'>%s</small>
    </div>",
			$this->model->get_label($this->attribute),
			$this->type,
			$this->attribute,
			$this->model->hasError($this->attribute) ? ' is-invalid' : '',
			$this->model->set_value($this->attribute) ?? '',
			$this->model->get_placeholder($this->attribute),
			$this->model->getFirstError($this->attribute),
			$this->model->get_hint($this->attribute)
		);
	}
	
	public function password_field()
	{
		$this->type = self::TYPE_PASSWORD;
		$this->password_value = '';
		return $this;
	}
	
	
	
}