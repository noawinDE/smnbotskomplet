<?php

require 'vendor/autoload.php';

if (isset($_GET['token'])) {
    $activate_user = \smnbots\User::activateAccount($_GET['token']);
}

if ($activate_user){
    $_SESSION['login.php']['success'] = true;
    header('Location: login');
} else {
    $_SESSION['login.php']['error'] = \smnbots\translation::getPHP()['ERROR_ACTIVATION_NOT_POSSIBLE'];
    header('Location: login?error');
}
