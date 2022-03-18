<h1>Login page</h1>

    <?php
        use app\core\form\Form;
        use app\core\Application;
    ?>
    <?php
    
    if (Application::$app->session->session_exists('userid')) {
	    Application::$app->response->redirect('profile');
    }
    
    ?>

    <?php if (Application::$app->session->getFlash("success")): ?>
     <div class="alert alert-danger">
       <?php echo Application::$app->session->getFlash("success"); ?>
     </div>
    <?php endif; ?>

    <?php $form = Form::begin(); ?>
        <?php echo $form->field($userModel, 'email'); ?>
        <?php echo $form->field($userModel, 'password')->password_field(); ?>
        <div class="mb-3 col"><button class="btn btn-primary">Submit login</button></div>
    <?php Form::end(); ?>


