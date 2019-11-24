<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireGuest();

if (isset($_SESSION['login.php']['error'])){
    $error = $_SESSION['login.php']['error'];
    unset($_SESSION['login.php']['error']);
}
$success = false;
if (isset($_SESSION['login.php']['success'])){
    $success = $_SESSION['login.php']['success'];
    unset($_SESSION['login.php']['success']);
}

if (isset($_POST['email'], $_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $response = $_POST["g-recaptcha-response"];

    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
        if (\smnbots\Auth::getInstance()->login($email,$password,false)) {
            header('Location: dashboard');
        } else {
            $error = "Benutzername und/oder Passwort sind falsch oder Ihr Konto wurde noch nicht aktiviert.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<script src="https://wchat.freshchat.com/js/widget.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>NXTBots.de | Login</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css" media="screen" type="text/css" />
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px; /* Margin bottom by footer height */
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            padding: 24px 0;

        }
        .login-container{
            height: calc(100vh - 60px);
        }
		.box {
			background: #2980b9;
		}
		input{
			border-radius:30px;
		}
    </style>
</head>
<body>
<div class="login-container">
    <div class="inner-container">
        <div class="box">
		<div class="auth-logo">
                    <img src="assets/img/auth-logo.png" width="300" class="center">
                </div>
            <form method="post" action="login.php">
                <input type="email" placeholder="E-Mail" name="email"/>
                <input type="password" placeholder="Passwort" name="password"/>
                
                <button class="btn btn-primary" type="submit">Login</button>
				 
            </form>
				<a href="register.php"><button class="btn btn-primary">Register</button></a>
        </div>
    </div>
</div>
<?php include 'assets/footer.php'?>
</body>
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/sweetalert2.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
<script src="assets/js/smnbots.js"></script>

<?php if (isset($error)){ ?>
    <script>
        smnswal({
            title: 'Fehler',
            html: '<?= $error ?>',
            type: "warning",
            timer: 5000,
        })
    </script>
<?php unset($error);
} elseif ($success){?>
    <script>
        smnswal({
            title: 'Fertig',
            html: 'Sie können sich nun Anmelden.',
            type: "success",
            timer: 5000,
        })
    </script>
    <?php
    $success = false;
} ?>
</html>