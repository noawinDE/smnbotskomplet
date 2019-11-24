<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireGuest();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['password'],$_POST['name'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $user = smnbots\User::register($name,$email,$password);
        if (!empty($user->errors)) {
            $error = $user->errors;
        } else {
            $success = true;
        }
        unset($_POST);
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Registrieren</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css" media="screen" type="text/css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
        .grecaptcha-badge{
            bottom: 74px!important;
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
            <form method="post" action="register.php" autocomplete="off">
                <input type="text" placeholder="Name" name="name" required/>
                <input type="email" placeholder="E-Mail" name="email" required/>
                <input type="password" placeholder="Passwort" name="password" required/>
				<!--<span><center><h9>Mit dem Regestrieren, akzeptierst du unsere </center></span>-->
                <div class="g-recaptcha"
                     data-sitekey="<?= \smnbots\Config::RC_SITEKEY ?>"
                     data-callback="doregister"
                     data-size="invisible">
                </div>
                <button type="submit" class="btn btn-primary" id="reqister">Registrieren</button>
				<!--<p style="margin-top: 16px;"></i>Bereits ein Account?</p> 
				 <a style="text-align: center; font-size: 15px; color: #FFFFFFFF; margin-top: 4px; margin-bottom: 32px;" a href="login">Jetzt anmelden!</a>-->
            </form>
				<a href="login.php"><button class="btn btn-primary">Login</button></a>
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
<script>
   
    $('#register').click(function (event) {
        event.preventDefault();
        grecaptcha.execute();
    });
    function doregister() {
        $('#register').submit();
    }
</script>
<?php if (isset($error)){ ?>
    <script>
        smnswal({
            title: 'Registrierung fehlgeschlagen',
            html: '<?php foreach ($error as $item){ echo $item."<br>";} ?>',
            type: "warning",
        })
    </script>
    <?php unset($error);
} elseif ($success){?>
    <script>
        smnswal({
            title: 'Fast fertig',
            html: 'Ihr Konto wurde erstellt. Bitte überprüfen Sie Ihren E-Mail-Posteingang, um Ihr Konto zu bestätigen.',
            type: "success",
        })
    </script>
<?php
    $success = false;
} ?>
</html>