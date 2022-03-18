<?php
namespace app\core;

use app\helper\database\Table;

abstract class Model {
	
	public array $errors;
	
	abstract public function requirements() : array;
	
	abstract public function placeholders() : array;
	
	abstract public function errorMessages() : array;
	
	abstract  public function newValues() : array;
	
	abstract public function labels(): array;
	
	abstract public function hints() : array;
	
	public function addError(string $attr, string $rule, $params = [])
	{
		$message = $this->errorMessages()[$rule] ?? '';
		foreach ($params as $param => $attr2) {
			$message = str_replace("{{$param}}", $attr2, $message);
		}
		$this->errors[$attr][] = $message;
	}
	
	public function loadData($data) {
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}
	}

	public function validate() {
		foreach ($this->requirements() as $field => $rules) {
			
			$value = $this->{$field};
			
			if ($rules['required'] === true && empty($value)) {
				$this->addError($field, 'required', ['field' => $field]);
			}
			
			if (isset($rules['min:validate']) && isset($rules['min']) && $rules['min:validate'] === true && strlen($value) < $rules['min']) {
				$this->addError($field, 'min', ['field' => $field, 'min' => $rules['min']]);
			}
			
			if (isset($rules['max:validate']) && isset($rules['max']) && $rules['max:validate'] === true && strlen($value) > $rules['max']) {
				$this->addError($field, 'max', ['field' => $field, 'max' => $rules['max']]);
			}
			
			if (isset($rules['type:validate']) && $rules['type:validate'] === true && isset($rules['type']) && $rules['type'] === 'string' && !is_string($value)) {
				$this->addError($field, 'type', ['field' => $field, 'type' => $rules['type']]);
			}
			
			if (isset($rules['type:validate']) && isset($rules['type']) &&  $rules['type:validate'] === true && $rules['type'] === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL) && !empty($value)) {
				$this->addError($field, 'type', ['field' => $field, 'type' => $rules['type']]);
			}
			
			if (isset($rules['type:validate']) && isset($rules['type']) &&  $rules['type:validate'] === true && $rules['type'] === 'url' && !filter_var($value, FILTER_VALIDATE_URL)) {
				$this->addError($field, 'type', ['field' => $field, 'type' => $rules['type']]);
			}
			
			if (isset($rules['type:validate']) && isset($rules['type']) &&  $rules['type:validate'] === true && $rules['type'] === 'number' && !filter_var($value, FILTER_VALIDATE_INT)) {
				$this->addError($field, 'type', ['field' => $field, 'type' => $rules['type']]);
			}
			
			if (isset($rules['match:validate']) && isset($rules['match']) &&  $rules['match:validate'] === true && $value !== $this->{$rules['match']}) {
				$this->addError($field, 'match', ['field' => $field, 'match' => $rules['match']]);
			}
		}
		return empty($this->errors);
	}
	
	public function hasError($field) {
		return $this->errors[$field] ?? false;
	}
	
	public function addCustom(string $attr, string $msg) {
		$this->errors[$attr][] = $msg;
	}
	
	public function getFirstError($attribute) {
		return $this->errors[$attribute][0] ?? false;
	}
	
	
	public function get_user_data($id)
	{
		$tbl = new Table();
		$data = $tbl->findManyOR(['id' => $id], "users");
		if ($data) {
			return $data;
		}
	}
	
	public function get_hint($attr) {
		return $this->hints()[$attr] ?? '';
	}

	public function get_placeholder($attr) {
		return $this->placeholders()[$attr] ?? '';
	}
	
	public function get_label($attr) {
		return $this->labels()[$attr] ?? $attr;
	}
	
	public function set_value($attr) {
		return $this->newValues()[$attr] ?? '';
	}
	
}