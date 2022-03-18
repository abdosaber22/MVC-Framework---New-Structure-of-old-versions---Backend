<?php


namespace app\core\http\models;

use app\core\Application;
use app\core\Model;
use app\helper\database\Table;


class UpdateUser extends Model
{
	
	public $update_firstname;
	public $update_lastname;
	public $update_username;
	public $update_email;
	
	public $verify_password;
	
	public function update_user() {
		
		$tbl = new Table();
		$dataOfUser = $this->get_user_data($_SESSION['userid']);
		
		if (!password_verify($this->verify_password, $dataOfUser->password)) {
			$this->addCustom('verify_password', 'Password is incorrect');
			return false;
		} else {
			return $tbl->update("username = '$this->update_username', email = '$this->update_email', firstname = '$this->update_firstname', lastname = '$this->update_lastname'", "users", "id", $_SESSION['userid']);
		}
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
	
	public function requirements() : array
	{
		return [
			'update_email' => [
				'required'  => true,
				'type:validate' => true,
				'type'      => 'email',
			
			],
			'update_firstname' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
			'update_lastname' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
			'update_username' => [
				'required' => true,
				'type:validate' => true,
				'type'      => 'string',
			],
			'verify_password' => [
				'required' => true,
				'type:validate' => true
			]
		];
	}
	
	public function placeholders() : array {
		return [
			'update_email' => 'Email-Address',
			'update_username' => 'Username',
			'update_lastname' => 'Lastname',
			'update_firstname' => 'Firstname',
			'verify_password' => 'Password Verification'
		];
	}
	
	public function labels(): array
	{
		return [
			'update_email' => 'Email-Address',
			'update_username' => 'Username',
			'update_lastname' => 'Lastname',
			'update_firstname' => 'Firstname',
			'verify_password' => 'Verify your password'
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
		$data = $this->get_user_data($_SESSION['userid']);
		return [
			'update_email' => $data->email,
			'update_firstname' => $data->firstname,
			'update_lastname' => $data->lastname,
			'update_username' => $data->username,
		];
	}
	
}
