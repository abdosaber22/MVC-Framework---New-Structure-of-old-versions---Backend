<?php

namespace app\helper\file_system;

class Upload {
	
	public $file;
	private $errors = [];
	public $move_to = '/somewhere/';
	public $extension_error = "The file you uploaded isn't allowed please try another";
	public $max_size_error  = "The File You Are Trying To Upload Is Too Big. Try another one";
	public $empty_error = "Please Choose A Picture";
	public $exists_error = "File Already Exists";
	private $connector;
	
	function __construct($file, $con)
	{
		$this->file = $file;
		$this->connector = $con;
	}
	
	public function is_good_file($extensions = ['jpg', 'png', 'svg', 'jpeg'], $max_size = 50000000)
	{
		$file_name      = 'uploaded/user_pics/' . $this->file['name'];
		$file_extension = explode('.', $this->file['name']);
		$file_extension = strtolower(end($file_extension));
		
		if (!in_array($file_extension, $extensions) && !empty($this->file['name'])) {
			$this->errors[] = $this->extension_error;
		}
		if (empty($this->file['name'])) {
			$this->errors[] = $this->empty_error;
		}
		if (filesize($this->file['tmp_name']) >= $max_size  && !empty($this->file['name'])) {
			$this->errors[] = $this->max_size_error;
		}
		if (file_exists($this->move_to . '/' . $this->file['name']) and !empty($this->file['name'])) {
			$this->errors[] = $this->exists_error;
		}
	}
	
	public function display_errors() {
		return $this->errors;
	}
	
	public function success()
	{
		if (empty($this->errors)) {
			$last = $this->move_to . '/uploaded_' . $this->file['name'];
			
			return move_uploaded_file($this->file['tmp_name'], $last);
			
		}
	}
	
}
