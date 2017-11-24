<?php

session_start();

require_once 'config.php';
require_once 'vendor/libs/auth/authlogin.php';
require_once 'vendor/libs/auth/authregister.php';
require_once 'vendor/libs/database.php';
require_once 'vendor/libs/functions.php';

if (isset($_POST['register'])) {

	$redirect = 'home';
	$registration = new Registration(); // create a new registration object - registration happens here

	setflash($registration->errors, 'fail');
	if (empty($registration->errors)) {
		setflash($registration->messages, 'success');
	}

} elseif (isset($_POST['login'])) {

	$redirect = 'home';
	$login = new login();

	setflash($login->errors, 'fail');
	if (empty($login->errors)) {
		$_SESSION["role"] = "user";
		setflash($login->messages, 'success');
	}
} elseif (isset($_GET['logout'])) {
	
	$login = new login();
	$redirect = 'home';
}

var_dump($_POST);

redirect(URL . $redirect);