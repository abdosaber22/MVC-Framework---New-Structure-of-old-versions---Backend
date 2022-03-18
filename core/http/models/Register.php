<?php


namespace app\core\http\models;

use app\core\Application;
use app\core\Model;
use app\helper\database\Table;


class Register extends Model
{
	
	public $new_firstname;
	public $new_lastname;
	public $new_username;
	public $new_email;
	
	public $new_password;
	
	
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
	
	public function requirements() : array
	{
		return [
			'new_email' => [
				'required'  => true,
				'type:validate' => true,
				'type'      => 'email',
			
			],
			'new_firstname' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
			'new_lastname' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
			'new_username' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
			'new_password' => [
				'required' => true,
				'type:validate' => true
			]
		];
	}
	
	public function placeholders() : array {
		return [
			'new_email' => 'Email-Address',
			'new_username' => 'Username',
			'new_lastname' => 'Lastname',
			'new_firstname' => 'Firstname',
			'new_password' => 'Password'
		];
	}
	
	public function labels(): array
	{
		return [
			'new_email' => 'Email-Address',
			'new_username' => 'Username',
			'new_lastname' => 'Lastname',
			'new_firstname' => 'Firstname',
			'new_password' => 'password'
		];
	}
	
	public function hints() : array {
		return [
			'new_email' => 'Please your email-address',
			'new_password' => 'What\'s your password',
		];
	}
	
	public function newValues(): array
	{
		return [];
	}
	
	public function add_user()
	{
		$stmt = new Table();
		$findIfExists = $stmt->findManyOR(['username' => $this->new_username, 'email' => $this->new_email], 'users', 'result');
		if ($findIfExists) {
			$this->addCustom("new_email", "This e-mail already exists, or username");
			return false;
		} else {
			return $this->save_user();
		}
	}
	
	private function save_user()
	{
		$stmt = new Table();
		$hashed = password_hash($this->new_password, PASSWORD_DEFAULT);
		return $stmt->run("INSERT INTO users (username, firstname, lastname, email, password) VALUES ('$this->new_username', '$this->new_firstname', '$this->new_lastname', '$this->new_email', '$hashed')");
		
	}
	
}
