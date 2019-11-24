<?php
require 'vendor/autoload.php';

if (\smnbots\Auth::getInstance()->isLoggedIn()){
    header('Location: dashboard');
} else {
    header('Location: login');
}