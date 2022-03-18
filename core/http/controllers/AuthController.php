<?php

namespace app\core\http\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\http\models\Register;
use app\core\Request;
use app\core\Response;
use app\core\http\models\User;
use app\core\http\models\UpdateUser;
use app\helper\database\Table;

class AuthController extends Controller
{
	
	private $userData = [];
	public string $layout = 'main';
	
	public function login(Request $request, Response $response) {
		$model = new User();
		if ($request->isPost()) {
			$model->loadData($request->getBody());
			$validation = $model->validate();
			$user       = $model->user_exists();
			if ($user && $validation) {
				Application::$app->session->setFlash("success", "Welcome back! Mr. " . $user->firstname . " You can update your profile info now!");
				Application::$app->session->set("userid", $user->id);
				$this->userData = $model;
				$response->redirect('profile');
			}
		}
		return $this->render('login', ['userModel' => $model]);
	}
	
	public function profile(Request $request, Response $response) {
		return $this->render('/profile', ['userModel' => $this->userData]);
	}
	
	public function logout(Request $request, Response $response) {
		return $this->render('profile_actions->logout');
	}
	
	public function update(Request $request, Response $response) {
		$update_model = new UpdateUser();
		if ($request->isPost()) {
			$update_model->loadData($request->getBody());
			$validation = $update_model->validate();
			$user       = $update_model->update_user();
			if ($validation && $user) {
				Application::$app->session->setFlash("updated_profile_success", "User Updated Successfully");
				$response->redirect('/framework/profile');
			} else {
				Application::$app->session->setFlash("updating_failure", "Something went wrong while updating information");
			}
		}
		return $this->render('profile_actions->update', ['userModel' => $update_model]);
	}
	
	public function register(Request $request, Response $response) {
		$register_model = new Register();
		
		if ($request->isPost()) {
			$register_model->loadData($request->getBody());
			$validate = $register_model->validate();
			$add_user = $register_model->add_user();
			$tbl = new Table();

			$getUser = $tbl->findManyOR(['username' => $register_model->new_username], 'users');
			
			if ($add_user && $validate) {

				Application::$app->session->set("userid", $getUser->id);
				Application::$app->session->setFlash("success", "Welcome back! Mr. " .  $getUser->firstname . " You can update your profile info now!");
				$response->redirect('profile');
			}
		}
		
		return $this->render('register', ['registerModel' => $register_model]);
	}

}