<h1>Update Profile</h1>

<?php
use app\core\form\Form;
use app\core\Application;
use function app\helper\functions\message;
?>
<?php

if (!Application::$app->session->session_exists('userid')) {
	Application::$app->response->redirect('login');
}

if (Application::$app->session->getFlash("updating_failure")) {
    echo message(Application::$app->session->getFlash("updating_failure"), "error");
}

?>

<?php $form = Form::begin(); ?>
<?php echo $form->field($userModel, 'update_firstname'); ?>
<?php echo $form->field($userModel, 'update_lastname'); ?>
<?php echo $form->field($userModel, 'update_username'); ?>
<?php echo $form->field($userModel, 'update_email'); ?>
<h4 class="fw-bold mt-5 mb-1 ml-2">Verify password</h4>
<?php echo $form->field($userModel, 'verify_password')->password_field(); ?>
<div class="mb-3 col"><button class="btn btn-primary">Submit login</button></div>
<?php Form::end(); ?>