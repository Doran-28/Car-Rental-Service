<?php
session_start();
require_once('../model/database.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require_once('../model/employee_db.php');

$action = filter_input(INPUT_POST, 'action');

// Determines if the user clicked logout.
if (isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();
	$action = NULL;
}

// Determines if the user is currently logged in via session
if(isset($_SESSION['employee_password'])) {
	$action = "logged_in";
}

// Shows appropriate page based on login
switch($action) {
	case NULL : 
		include('employee_login.php');
		break;

	case "request_login" :
		require_once('../model/database.php');

		// Gather login info
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');

		if (is_valid_employee_login($username, $password)) {
	        $_SESSION['employee_password'] = $password;
	        include('employee_home.php');
	    	break;
	    } else {
	         $error = "Invalid login, please try again.";
	         include('employee_login.php');
	    	 break;
	    }
	    break;

	case "logged_in" :
		include('employee_home.php');
		break;
}
?>