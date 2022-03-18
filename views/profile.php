
<?php use app\core\Application;
use app\core\http\models\User; ?>

<?php
	$userModel = new User();
	$data = $userModel->get_user_data($_SESSION['userid']);
	
?>

<?php if (Application::$app->session->getFlash('success')): ?>
	<?php echo Application::$app->session->getFlash('success'); ?>
<?php endif; ?>

<?php if (Application::$app->session->getFlash("updated_profile_success")): ?>
    <div class="alert alert-success">
	    <?php echo Application::$app->session->getFlash("updated_profile_success"); ?>
    </div>
<?php endif; ?>

<div class="container" style="margin-top: 20px;">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?> <span style="font-size: 15px; font-weight: lighter; color: #8a8888">@<?php echo $data->username; ?></span></h5>
			<h6 class="card-subtitle mb-2 text-muted">E-mail Address: <?php echo $data->email; ?></h6>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="profile/update" class="card-link btn btn-primary">Update Account</a>
            <a href="/framework/profile/logout" class="card-link btn btn-danger">Logout</a>
		</div>
	</div>
</div>


