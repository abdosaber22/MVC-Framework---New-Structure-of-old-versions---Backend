<?php
    use app\config\Assets;
    use app\core\http\models\User;
    
    $userM = new User();
    $data = @$userM->get_user_data($_SESSION['userid']);
?>
<html>
<head>
    <title>{{title}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Update</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Set data</a></li>
                </ul>
                
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['userid'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/framework/profile">Profile</a></li>
                    <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                     <li class="nav-item"><a class="nav-link" href="register">Register</a></li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
    
    <div class="container">{{content}}</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>