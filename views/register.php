<h1>Create new account</h1>

<?php
/** @var $registerModel \app\core\http\models\Register */
use app\core\form\Form;
use app\core\Application;
use function app\helper\functions\message;
?>
<?php

if (Application::$app->session->session_exists('userid')) {
	Application::$app->response->redirect('profile');
}

if (Application::$app->session->getFlash("register_failed")) {
	echo message(Application::$app->session->getFlash("register_failed"), "error");
}

?>


<?php $form = Form::begin(); ?>
<?php echo $form->field($registerModel, 'new_firstname'); ?>
<?php echo $form->field($registerModel, 'new_lastname'); ?>
<?php echo $form->field($registerModel, 'new_username'); ?>
<?php echo $form->field($registerModel, 'new_email'); ?>
<?php echo $form->field($registerModel, 'new_password')->password_field(); ?>
<div class="mb-3 col"><button class="btn btn-primary">Submit login</button></div>
<?php Form::end(); ?>