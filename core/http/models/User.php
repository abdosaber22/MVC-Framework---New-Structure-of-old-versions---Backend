<?php


namespace app\core\http\models;


use app\core\Application;
use app\core\Model;
use app\helper\database\Table;

class User extends Model
{

	public $email;
	public $password;
	

	public function requirements() : array
	{
		return [
			'email' => [
				'required'  => true,
				'type:validate' => true,
				'type'      => 'email',
				
			],
			'password' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
		];
	}
	
	public function errorMessages() : array {
		return [
			'required'  => 'This field {field} is required',
			'type'      => '{field} is not {type}',
			'max'       => 'This field {field} has its maximum length',
			'match'     => 'This field {field} does not match with {match}',
			'min'       => 'This field {field} has minimum length {min}',
			'unique'    => 'This {field} already exists, please try another'
		];
	}
	
	public function labels(): array
	{
		return [
			'email' => 'Email-Address',
			'password' => 'Password',
		];
	}
	
	public function hints() : array {
		return [
	
			'email' => 'Please your email-address',
			'password' => 'What\'s your password',
		];
	}
	
	public function newValues(): array
	{
		return [];
	}
	
	public function user_exists()
	{
		$tbl = new Table();
		$data = $tbl->findManyOR(['email' => $this->email], "users");
		if (!$data) {
			$this->addCustom('email', 'There\'s no user with this email address');
			return false;
		}
		if (!password_verify($this->password, $data->password)) {
			$this->addCustom('password', 'Password is incorrect');
			return false;
		}
		
		if ($data && password_verify($this->password, $data->password)) {
			return $data;
		}
		
	}
	
	public function get_user_data($id)
	{
		$tbl = new Table();
		$data = $tbl->findManyOR(['id' => $id], "users");
		if ($data) {
			return $data;
		}
	}
	
	public function placeholders() : array {
		return [
			'email' => 'Email-Address',
			'password' => 'Password'
		];
	}
}