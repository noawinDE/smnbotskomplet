<?php
require 'vendor/autoload.php';

\smnbots\Auth::getInstance()->logout();
header('Location: login');